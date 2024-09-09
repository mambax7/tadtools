<!DOCTYPE html>
<html lang="<{$xoops_langcode}>">
  <head>
    <meta http-equiv="Refresh" content="<{$time}>; url=<{$url}>"/>
    <{assign var="theme_name" value=$xoTheme->folderName}>
    <{include file="$xoops_rootpath/modules/tadtools/themes_common/meta.tpl"}>
    <!-- 網站的標題及標語 -->
    <title><{$xoops_sitename}> - <{$xoops_pagetitle}></title>

    <script src="<{$xoops_url}>/modules/tadtools/sweet-alert/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<{$xoops_url}>/modules/tadtools/sweet-alert/sweetalert2.min.css">
  </head>

  <body>
    <script>
      Swal.fire({
        position: 'top-center',
        icon: 'info',
        title: '<{$message}>',
        showConfirmButton: false,
        timer: 3000
      })
    </script>
  </body>
</html>
