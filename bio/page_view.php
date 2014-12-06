<!DOCTYPE html>
<html lang="en">
<?
    try {
        $body = $this->get_view();
        $less = $assets->less->compile();
        $js   = $assets->js->compile();
    } catch (Exception $ex) {
        $body = $this->scope->__wrapException($ex)->get_view();
    }
?>
    <head>
        <meta charset="utf-8" />

        <?if($this instanceof Oxygen_Controller){?>
        <title><?=$this->company?></title>
        <?}?>

    
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/assets/map/ammap.css">
        <?=$this->put_stylesheets()?>
        <?//$this->scope->assets->css->put_view()?>

        <script src="<?=$this->scope->lib->url('js/oxygen.js')?>"></script>
        <script src="<?=$this->scope->lib->url('js/jquery-ui-1.8.20.custom.min.js')?>"></script>
        <script src="<?=$this->scope->lib->url('js/moment.js')?>"></script>
        <script src="<?=$this->scope->lib->url('js/angular.js')?>"></script>
        <script type="text/javascript" src="http://ulow.koding.io:8000/faye/client.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <script type="text/javascript">
            window.jQuery = window.oxygen.$;
            window.$ = window.oxygen.$;
        </script>

        <?=$this->put_javascripts()?>

        <style>
            html, body
            {
                height: 100%;
                margin: 0px;
                padding: 0px;

                font-family: Verdana, Arial, Helvetica, Tahoma, sans-serif;
                font-size: 12px;
            }

            html{
              height: 100%;
            }
            body {
              min-height: 100%;
            }
            
            #mapdiv {
                background: #3f3f4f;color:#ffffff;
                width		: 100%;
                height		: 900px;
                font-size	: 11px;
            }
            .container-biosphere {
                width: 100%;
                margin-top: 20px;
            }
        </style>
        
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/map/ammap.js" type="text/javascript"></script>
        <script src="/assets/map/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="/assets/map/themes/dark.js" type="text/javascript"></script>
    </head>

    <body ng-app='game'>
        <?=$body?>
    </body>
</html>