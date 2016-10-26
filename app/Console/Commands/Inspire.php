<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $infos = \App\Info::where('status',0)->where('file_type',1)->get();
        foreach( $infos as $info){
            $response = \App\Helper\HttpClient::get('https://openapi.youku.com/v2/videos/show.json?client_id='.env('YOUKU_CLIENT_ID').'&video_id='.$info->file);
            $result = json_decode($response);
            if( !isset($result->error) && $result->state == 'normal' ){
                $row = \App\Info::find($info->id);
                $row->thumb = $result->bigThumbnail;
                $row->status = 1;
                $row->save();
                $this->info(PHP_EOL.'  优酷视频 '.$info->file.' 获取预览图成功~'.PHP_EOL);
            }
            else{
                $this->error(PHP_EOL.'  优酷视频 '.$info->file.' 获取预览图失败~'.PHP_EOL);
            }
        }
        //$this->comment($infos);
        //$this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }
}
