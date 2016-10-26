<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\ImageManagerStatic as Image;

class Animation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animation {file} {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file_name = $this->argument('file');
        $type = $this->argument('type');
        $file_path = public_path('storage/animation/');
        $array_file = explode('.', $this->argument('file'));
        $images = [];
        for ($i=1; $i <= 4; $i++) {
            $image = Image::make($file_path.$file_name);
            $mask = public_path('png/'.$type.$i.'.png');
            $image->fill($mask);
            $tmp_file = public_path('storage/animation/').date('YmdHis').uniqid().'.'.$array_file[1];
            $image->save($tmp_file);
            $images[] = $tmp_file;
        }

        @unlink($file_path.$file_name);

        $gif = public_path('storage/animation/').$array_file[0].'.gif';
        $cmd = env('CONVERT_PATH').' -delay 22 -loop 0 ';
        foreach ($images as $v) {
          $cmd .= $v.' ';
        }
        $cmd .= $gif;
        //$this->info($cmd);
        exec($cmd);
        #删除文件
        foreach( $images as $v){
            @unlink($v);
        }
        $this->info(PHP_EOL.$this->argument('file').' '.$this->argument('type').PHP_EOL);
    }
}
