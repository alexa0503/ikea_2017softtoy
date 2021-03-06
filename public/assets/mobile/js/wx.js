function wxShare(data){
    wx.config({
        debug: data.debug || false,
        appId: data.appId,
        timestamp: data.timestamp,
        nonceStr: data.nonceStr,
        signature: data.signature,
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage'
        ]
    });
    wx.ready(function () {
        wx.onMenuShareAppMessage({
            title: data.title,
            desc: data.desc,
            link: data.link,
            imgUrl: data.imgUrl,
            trigger: function (res) {},
            success: function (res) {
                ga('send', 'event', 'share', 'click', 'myartwork_share');
            },
            cancel: function (res) {},
            fail: function (res) {}
        });
        wx.onMenuShareTimeline({
            title: data.desc,
            link: data.link,
            imgUrl: data.imgUrl,
            trigger: function (res) {},
            success: function (res) {
                ga('send', 'event', 'share', 'click', 'myartwork_share');
            },
            cancel: function (res) {},
            fail: function (res) {}
        });
    });
}
