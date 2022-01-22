<div id="gtranslate_wrapper" style="display:none;position:fixed;bottom:0;right:8%;z-index:9999999999;">
    <!-- GTranslate: https://gtranslate.io/ -->
    <style>
    .switcher {
        font-family: Arial;
        font-size: 10pt;
        text-align: left;
        cursor: pointer;
        overflow: hidden;
        width: 163px;
        line-height: 17px;
    }

    .switcher a {
        text-decoration: none;
        display: block;
        font-size: 10pt;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
    }

    .switcher a img {
        vertical-align: middle;
        display: inline;
        border: 0;
        padding: 0;
        margin: 0;
        opacity: 0.8;
    }

    .switcher a:hover img {
        opacity: 1;
    }

    .switcher .selected {
        background: #fff linear-gradient(180deg, #efefef 0%, #fff 70%);
        position: relative;
        z-index: 9999;
    }

    .switcher .selected a {
        border: 1px solid #ccc;
        color: #666;
        padding: 3px 5px;
        width: 151px;
    }

    .switcher .selected a:after {
        height: 16px;
        display: inline-block;
        position: absolute;
        right: 5px;
        width: 15px;
        background-position: 50%;
        background-size: 7px;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 285 285'><path d='M282 76.5l-14.2-14.3a9 9 0 0 0-13.1 0L142.5 174.4 30.3 62.2a9 9 0 0 0-13.2 0L3 76.5a9 9 0 0 0 0 13.1l133 133a9 9 0 0 0 13.1 0l133-133a9 9 0 0 0 0-13z' style='fill:%23666666'/></svg>");
        background-repeat: no-repeat;
        content: "" !important;
        transition: all .2s;
    }

    .switcher .selected a.open:after {
        -webkit-transform: rotate(-180deg);
        transform: rotate(-180deg);
    }

    .switcher .selected a:hover {
        background: #fff
    }

    .switcher .option {
        position: relative;
        z-index: 9998;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        background-color: #eeeeee;
        display: none;
        width: 161px;
        max-height: 198px;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .switcher .option a {
        color: #000;
        padding: 3px 5px;
    }

    .switcher .option a:hover {
        background: #fff;
    }

    .switcher .option a.selected {
        background: #fff;
    }

    #selected_lang_name {
        float: none;
    }

    .l_name {
        float: none !important;
        margin: 0;
    }

    .switcher .option::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
        background-color: #f5f5f5;
    }

    .switcher .option::-webkit-scrollbar {
        width: 5px;
    }

    .switcher .option::-webkit-scrollbar-thumb {
        border-radius: 5px;
        -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, .3);
        background-color: #888;
    }
    </style>
    <div class="switcher notranslate">
        <div class="selected">
            <a href="#" onclick="return false;"><img src="//gtranslate.io/shopify/assets/flags/16/es.png" height="16"
                    width="16" alt="es" /> Spanish</a>
        </div>
        <div class="option">
            <a href="#"
                onclick="doGTranslate('es|es');jQuery_gtranslate('div.switcher div.selected a').html(jQuery_gtranslate(this).html());return false;"
                title="Spanish" class="nturl selected"><img
                    data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/es.png" height="16" width="16" alt="es" />
                Spanish</a><a href="#"
                onclick="doGTranslate('es|en');jQuery_gtranslate('div.switcher div.selected a').html(jQuery_gtranslate(this).html());return false;"
                title="English" class="nturl"><img data-gt-lazy-src="//gtranslate.io/shopify/assets/flags/16/en.png"
                    height="16" width="16" alt="en" /> English</a>
        </div>
    </div>
    <script>
    function GTranslateGetCurrentLang() {
        var keyValue = document.cookie.match('(^|;) ?googtrans=([^;]*)(;|$)');
        return keyValue ? keyValue[2].split('/')[2] : null;
    }

    function gt_loadScript(url, callback) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        if (script.readyState) {
            script.onreadystatechange = function() {
                if (script.readyState == "loaded" || script.readyState == "complete") {
                    script.onreadystatechange = null;
                    callback()
                }
            }
        } else {
            script.onload = function() {
                callback()
            }
        }
        script.src = url;
        document.getElementsByTagName("head")[0].appendChild(script)
    }
    var gtSwitcherJS = function($) {
        $('.switcher .selected').click(function() {
            $('.switcher .option a img').each(function() {
                if (!$(this)[0].hasAttribute('src')) $(this).attr('src', $(this).attr(
                    'data-gt-lazy-src'))
            });
            if (!($('.switcher .option').is(':visible'))) {
                $('.switcher .option').stop(true, true).delay(100).slideDown(500);
                $('.switcher .selected a').toggleClass('open')
            }
        });
        $('.switcher .option').bind('mousewheel', function(e) {
            var options = $('.switcher .option');
            if (options.is(':visible')) options.scrollTop(options.scrollTop() - e.originalEvent.wheelDelta /
                10);
            return false;
        });
        $('body').not('.switcher').bind('click', function(e) {
            if ($('.switcher .option').is(':visible') && e.target != $('.switcher .option').get(0)) {
                $('.switcher .option').stop(true, true).delay(100).slideUp(500);
                $('.switcher .selected a').toggleClass('open')
            }
        });
        if (typeof GTranslateGetCurrentLang == 'function')
            if (GTranslateGetCurrentLang() != null) $(document).ready(function() {
                var lang_html = $('div.switcher div.option').find('img[alt="' + GTranslateGetCurrentLang() +
                    '"]').parent().html();
                if (typeof lang_html != 'undefined') $('div.switcher div.selected a').html(lang_html
                    .replace('data-gt-lazy-', ''));
            });
    };
    gt_loadScript("//code.jquery.com/jquery-1.12.4.min.js", function() {
        jQuery_gtranslate = jQuery.noConflict(true);
        gtSwitcherJS(jQuery_gtranslate);
    });
    </script>

    <style>
    #goog-gt-tt {
        display: none !important;
    }

    .goog-te-banner-frame {
        display: none !important;
    }

    .goog-te-menu-value:hover {
        text-decoration: none !important;
    }

    body {
        top: 0 !important;
    }

    #google_translate_element2 {
        display: none !important;
    }
    </style>
    <div id="google_translate_element2"></div>
    <script>
    function googleTranslateElementInit2() {
        new google.translate.TranslateElement({
            pageLanguage: 'es',
            autoDisplay: false
        }, 'google_translate_element2');
    }
    if (!window.gt_translate_script) {
        window.gt_translate_script = document.createElement('script');
        gt_translate_script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2';
        document.body.appendChild(gt_translate_script);
    }
    </script>

    <script>
    if (typeof GTranslateGetCurrentLang != 'function')
    function GTranslateGetCurrentLang() {
        var keyValue = document.cookie.match('(^|;) ?googtrans=([^;]*)(;|$)');
        return keyValue ? keyValue[2].split('/')[2] : null;
    }

    function GTranslateFireEvent(element, event) {
        try {
            if (document.createEventObject) {
                var evt = document.createEventObject();
                element.fireEvent('on' + event, evt)
            } else {
                var evt = document.createEvent('HTMLEvents');
                evt.initEvent(event, true, true);
                element.dispatchEvent(evt)
            }
        } catch (e) {}
    }

    function doGTranslate(lang_pair) {
        if (lang_pair.value) lang_pair = lang_pair.value;
        if (lang_pair == '') return;
        var lang = lang_pair.split('|')[1];
        if (GTranslateGetCurrentLang() == null && lang == lang_pair.split('|')[0]) return;
        if (typeof ga == 'function') {
            ga('send', 'event', 'GTranslate', lang, location.hostname + location.pathname + location.search);
        } else {
            if (typeof _gaq != 'undefined') _gaq.push(['_trackEvent', 'GTranslate', lang, location.hostname + location
                .pathname + location.search
            ]);
        }
        var teCombo;
        var sel = document.getElementsByTagName('select');
        for (var i = 0; i < sel.length; i++)
            if (/goog-te-combo/.test(sel[i].className)) teCombo = sel[i];
        if (document.getElementById('google_translate_element2') == null || document.getElementById(
                'google_translate_element2').innerHTML.length == 0 || teCombo.length == 0 || teCombo.innerHTML.length ==
            0) {
            setTimeout(function() {
                doGTranslate(lang_pair)
            }, 500)
        } else {
            teCombo.value = lang;
            GTranslateFireEvent(teCombo, 'change');
            GTranslateFireEvent(teCombo, 'change')
        }
    }
    </script>
    <style>
    a.glink {
        text-decoration: none;
    }

    a.glink span {
        margin-right: 3px;
        font-size: 10px;
        vertical-align: middle;
    }

    a.glink img {
        vertical-align: middle;
        display: inline;
        border: 0;
        padding: 0;
        margin: 0;
        opacity: 0.8;
    }

    a.glink:hover img {
        opacity: 1;
    }
    </style>
</div>
<script>
setTimeout(function() {
    if (typeof window.gtranslate_installed == "undefined" && typeof console != "undefined") console.log(
        "To uninstall GTranslate properly please follow the instructions on https://docs.gtranslate.io/how-tos/how-to-remove-gtranslate-app-from-shopify"
        )
}, 4000);
</script>