<script async defer src="https://cdn.captchafox.com/api.js?onload=cscartLoadCaptchaFox&render=explicit"></script>

<script type="text/javascript">
//<![CDATA[
var cscartLoadCaptchaFox = function () {
    $('.captchafox').each(function() {
        captchafox.render(this, {
            'sitekey': '{$addons.captchafox.site_key}',
            'lang' : '{$addons.captchafox.lang}',
            'mode' : '{$addons.captchafox.mode}'
        });
    });
};
//]]>
</script>