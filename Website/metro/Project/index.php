<!DOCTYPE html>

<html lang="nl">
    <head>
        <meta charset="utf-8" />
        <background-image src="1.jpg" alt=""/>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

        <meta content="Project OV Groninen - Grid" name="description" />
        <meta content="Wesley Pruim" name="author" />

        <meta content="index, follow" name="robots" />

        <title>Project OV Groningen - Grid</title>

        <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <link href="./stylesheets/grid.css" rel="stylesheet" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="./javascripts/grid.js"></script>
    </head>

    <body>
        <table>
<?php
for ($i = 0; $i < 50; $i++)
{
?>
            <tr>
<?php
    for($j = 0; $j < 50; $j++)
    {
?>
                <td></td>
<?php
    }
?>
            </tr>
<?php
}
?>
        </table>
            <div class="add_station" title="Halte toevoegen">
                <p>Voeg een halte toe.</p>
                <form>
                    <fieldset>
                        <label for="halte">Halte</label>
                        <input type="text" name="halte" id="halte"</br></br></br>
                        <label for="type">Type</label></br>
                        <input class="input" type="checkbox" name="type" value="1" id="type">Auto</br>
                        <input class="input" type="checkbox" name="type" value="2">Taxi</br>
                        <input class="input" type="checkbox" name="type" value="3">Bus</br>
                        <input class="input" type="checkbox" name="type" value="4">Trein</br></br>   
                    </fieldset>
                </form>
            </div>
        </body>
</html>