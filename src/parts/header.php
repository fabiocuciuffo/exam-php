<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
            global $pageTitle;
            if (!empty($pageTitle)) {
                echo $pageTitle;
            } else {
                echo 'Exam PHP';
            }
            ?></title>
</head>

<body>