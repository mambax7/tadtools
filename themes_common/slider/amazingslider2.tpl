<script src="<{$xoops_url}>/modules/tadtools/themes_common/slider/sliderengine/amazingslider.js"></script>
<script src="<{$xoops_url}>/modules/tadtools/themes_common/slider/sliderengine/initslider-2.js"></script>

<!-- Insert to your webpage where you want to display the slider -->
<div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:100%;margin:0 auto;">
    <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
        <ul class="amazingslider-slides" style="display:none;">
          <{foreach from=$slider_var item=slide key=i}>
            <{if $slide.slide_url|default:false}>
              <li><a href="<{$slide.slide_url}>" <{$slide.slide_target}>><img src="<{$slide.file_url}>" alt="<{$slide.description}>" /></a></li>
            <{else}>
              <li><img src="<{$slide.file_url}>" alt="<{$slide.description}>" /></li>
            <{/if}>
          <{/foreach}>
        </ul>
        <ul class="amazingslider-thumbnails" style="display:none;">
          <{foreach from=$slider_var item=slide key=i}>
            <li><img src="<{$slide.file_thumb_url}>" alt="<{$slide.text_description}>" /></li>
          <{/foreach}>
        </ul>
    <div class="amazingslider-engine"><a href="http://amazingslider.com" title="Slider jQuery">Slider jQuery</a></div>
    </div>
</div>
<!-- End of body section HTML codes -->
