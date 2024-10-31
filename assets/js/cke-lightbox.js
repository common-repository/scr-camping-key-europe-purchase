function CampingKeyEurope(camping, lang) {
    if (!jQuery.easybox.isOpen()) {
        var height = 1000;
        if (jQuery(window).height() < height) {
            height = (jQuery(window).height() - 100);
        }
        if (height < 300)
            height = 300;

        var width = 700
        if (jQuery(window).width() < width) {
            width = (jQuery(window).width() - 100);
        }
        if (width < 300)
            width = 300;

        url = "https://buy.campingkeyeurope.se/" + lang + "/" + camping + "/modul/";
        jQuery.easybox([{ url: url, width: width, height: height, dragDrop: false, noClose: true }]);
    }
}