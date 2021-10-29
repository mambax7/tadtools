<?php

namespace XoopsModules\Tadtools;

use XoopsModules\Tadtools\Utility;

class SyntaxHighlighter
{
    //建構函數
    public function __construct()
    {
    }

    //產生語法
    public function render($mode = "", $version = "")
    {
        global $xoTheme;
        Utility::get_jquery();
        $TadToolsModuleConfig = Utility::TadToolsXoopsModuleConfig();

        $syntaxhighlighter_themes = !empty($TadToolsModuleConfig['syntaxhighlighter_themes']) ? $TadToolsModuleConfig['syntaxhighlighter_themes'] : 'shThemeDefault';

        if ($xoTheme && $mode != 'return') {
            if ($version == 2) {
                $dir = 'modules/tadtools/syntaxhighlighter_2';
                $dir2 = XOOPS_URL . '/modules/tadtools/syntaxhighlighter_2';
            } elseif ($version == 3) {
                $dir = 'modules/tadtools/syntaxhighlighter';
                $dir2 = XOOPS_URL . '/modules/tadtools/syntaxhighlighter';
            } else {
                $dir = !empty($TadToolsModuleConfig['syntaxhighlighter_version']) ? 'modules/tadtools/' . $TadToolsModuleConfig['syntaxhighlighter_version'] : 'modules/tadtools/syntaxhighlighter';

                $dir2 = !empty($TadToolsModuleConfig['syntaxhighlighter_version']) ? XOOPS_URL . '/modules/tadtools/' . $TadToolsModuleConfig['syntaxhighlighter_version'] : XOOPS_URL . '/modules/tadtools/syntaxhighlighter';
            }

            $xoTheme->addStylesheet("$dir/styles/shCore.css");
            $xoTheme->addStylesheet("$dir/styles/{$syntaxhighlighter_themes}.css");

            if ('syntaxhighlighter_2' === $TadToolsModuleConfig['syntaxhighlighter_version']) {
                $xoTheme->addScript("$dir/scripts/shCore.js");
                $xoTheme->addScript("$dir/scripts/shBrushAS3.js");
                $xoTheme->addScript("$dir/scripts/shBrushBash.js");
                $xoTheme->addScript("$dir/scripts/shBrushColdFusion.js");
                $xoTheme->addScript("$dir/scripts/shBrushCpp.js");
                $xoTheme->addScript("$dir/scripts/shBrushCSharp.js");
                $xoTheme->addScript("$dir/scripts/shBrushCss.js");
                $xoTheme->addScript("$dir/scripts/shBrushDelphi.js");
                $xoTheme->addScript("$dir/scripts/shBrushDiff.js");
                $xoTheme->addScript("$dir/scripts/shBrushErlang.js");
                $xoTheme->addScript("$dir/scripts/shBrushGroovy.js");
                $xoTheme->addScript("$dir/scripts/shBrushJava.js");
                $xoTheme->addScript("$dir/scripts/shBrushDelphi.js");
                $xoTheme->addScript("$dir/scripts/shBrushJScript.js");
                $xoTheme->addScript("$dir/scripts/shBrushPerl.js");
                $xoTheme->addScript("$dir/scripts/shBrushPhp.js");
                $xoTheme->addScript("$dir/scripts/shBrushPlain.js");
                $xoTheme->addScript("$dir/scripts/shBrushPowerShell.js");
                $xoTheme->addScript("$dir/scripts/shBrushPython.js");
                $xoTheme->addScript("$dir/scripts/shBrushRuby.js");
                $xoTheme->addScript("$dir/scripts/shBrushScala.js");
                $xoTheme->addScript("$dir/scripts/shBrushSql.js");
                $xoTheme->addScript("$dir/scripts/shBrushVb.js");
                $xoTheme->addScript("$dir/scripts/shBrushXml.js");

                $xoTheme->addScript('', null, "
                  SyntaxHighlighter.config.clipboardSwf = '{$dir2}/scripts/clipboard.swf';
                  SyntaxHighlighter.all();
                ");
            } else {
                $xoTheme->addScript("$dir/scripts/shCore.js");
                $xoTheme->addScript("$dir/scripts/shAutoloader.js");

                $xoTheme->addScript('', null, "
                  function path()
                  {
                    var args = arguments,
                    result = [];
                    for(var i = 0; i < args.length; i++)
                        result.push(args[i].replace('@', '{$dir2}/scripts/'));
                    return result
                  };

                  \$(document).ready(function(){
                    SyntaxHighlighter.autoloader.apply(null, path(
                    'applescript            @shBrushAppleScript.js',
                    'actionscript3 as3      @shBrushAS3.js',
                    'bash shell             @shBrushBash.js',
                    'coldfusion cf          @shBrushColdFusion.js',
                    'cpp c                  @shBrushCpp.js',
                    'c# c-sharp csharp      @shBrushCSharp.js',
                    'css                    @shBrushCss.js',
                    'delphi pascal          @shBrushDelphi.js',
                    'diff patch pas         @shBrushDiff.js',
                    'erl erlang             @shBrushErlang.js',
                    'groovy                 @shBrushGroovy.js',
                    'java                   @shBrushJava.js',
                    'jfx javafx             @shBrushJavaFX.js',
                    'js jscript javascript  @shBrushJScript.js',
                    'perl pl                @shBrushPerl.js',
                    'php                    @shBrushPhp.js',
                    'text plain             @shBrushPlain.js',
                    'py python              @shBrushPython.js',
                    'ruby rails ror rb      @shBrushRuby.js',
                    'sass scss              @shBrushSass.js',
                    'scala                  @shBrushScala.js',
                    'sql                    @shBrushSql.js',
                    'vb vbnet               @shBrushVb.js',
                    'xml xhtml xslt html    @shBrushXml.js'
                    ));
                    SyntaxHighlighter.defaults['smart-tabs'] = true;
                    SyntaxHighlighter.defaults['tab-size'] = 2;
                    SyntaxHighlighter.defaults['toolbar'] = false;

                    SyntaxHighlighter.all();
                  });

                ");
            }

            $xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/prism/prism.css');
            $xoTheme->addScript(XOOPS_URL . '/modules/tadtools/prism/prism.js');
        } else {
            $dir = !empty($TadToolsModuleConfig['syntaxhighlighter_version']) ? XOOPS_URL . '/modules/tadtools/' . $TadToolsModuleConfig['syntaxhighlighter_version'] : XOOPS_URL . '/modules/tadtools/syntaxhighlighter';

            $syntaxhighlighter = "
              <link type='text/css' rel='stylesheet' href='{$dir}/styles/shCore.css'>
              <link type='text/css' rel='stylesheet' href='{$dir}/styles/{$syntaxhighlighter_themes}.css'>
              ";

            if ('syntaxhighlighter_2' === $TadToolsModuleConfig['syntaxhighlighter_version']) {
                $syntaxhighlighter .= "
                <script type='text/javascript' src='{$dir}/scripts/shCore.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushAS3.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushBash.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushColdFusion.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushCpp.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushCSharp.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushCss.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushDelphi.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushDiff.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushErlang.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushGroovy.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushJava.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushDelphi.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushJScript.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushPerl.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushPhp.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushPlain.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushPowerShell.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushPython.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushRuby.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushScala.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushSql.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushVb.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shBrushXml.js'></script>
                <script type='text/javascript'>
                  SyntaxHighlighter.config.clipboardSwf = '{$dir}/scripts/clipboard.swf';
                  SyntaxHighlighter.all();
                </script>";
            } else {
                $syntaxhighlighter .= "
                <script type='text/javascript' src='{$dir}/scripts/shCore.js'></script>
                <script type='text/javascript' src='{$dir}/scripts/shAutoloader.js'></script>
                <style>
                  .syntaxhighlighter table .container:before {
                      display: none !important;
                  }
                </style>
                <script type='text/javascript'>
                  function path()
                  {
                      var args = arguments,
                      result = [];
                      for(var i = 0; i < args.length; i++)
                          result.push(args[i].replace('@', '{$dir}/scripts/'));
                      return result
                  };

                  $(document).ready(function(){
                    SyntaxHighlighter.autoloader.apply(null, path(
                    'applescript            @shBrushAppleScript.js',
                    'actionscript3 as3      @shBrushAS3.js',
                    'bash shell             @shBrushBash.js',
                    'coldfusion cf          @shBrushColdFusion.js',
                    'cpp c                  @shBrushCpp.js',
                    'c# c-sharp csharp      @shBrushCSharp.js',
                    'css                    @shBrushCss.js',
                    'delphi pascal          @shBrushDelphi.js',
                    'diff patch pas         @shBrushDiff.js',
                    'erl erlang             @shBrushErlang.js',
                    'groovy                 @shBrushGroovy.js',
                    'java                   @shBrushJava.js',
                    'jfx javafx             @shBrushJavaFX.js',
                    'js jscript javascript  @shBrushJScript.js',
                    'perl pl                @shBrushPerl.js',
                    'php                    @shBrushPhp.js',
                    'text plain             @shBrushPlain.js',
                    'py python              @shBrushPython.js',
                    'ruby rails ror rb      @shBrushRuby.js',
                    'sass scss              @shBrushSass.js',
                    'scala                  @shBrushScala.js',
                    'sql                    @shBrushSql.js',
                    'vb vbnet               @shBrushVb.js',
                    'xml xhtml xslt html    @shBrushXml.js'
                    ));
                    SyntaxHighlighter.defaults['smart-tabs'] = true;
                    SyntaxHighlighter.defaults['tab-size'] = 2;
                    SyntaxHighlighter.defaults['toolbar'] = false;

                    SyntaxHighlighter.all();
                  });

                </script>";
            }

            return $syntaxhighlighter;
        }
    }
}

/*
use XoopsModules\Tadtools\SyntaxHighlighter;

$SyntaxHighlighter = new SyntaxHighlighter();
$SyntaxHighlighter->render();

<pre class="brush: js">
</pre>
 */
