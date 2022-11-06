<?php

namespace TaskForProman;

require_once("Users.php");
require_once("AccountType.php");
require_once("DatabaseConnector.php");
require_once("Customer.php");
require_once("Admin.php");
require_once("UserExistsException.php");
require_once("UsersList.php");


$UsersList = new UsersList();
$allDataQuery = new DatabaseConnector("SELECT * FROM Users");
foreach ($allDataQuery->getData() as $user) {
    if ($user->TYPE) $UsersList->add(new Admin($user->ID, $user->NAME, $user->SECONDNAME, $user->ONLINE));
    else $UsersList->add(new Customer($user->ID, $user->NAME, $user->SECONDNAME, $user->ONLINE));
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            Task for Proman
        </title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        NAME
                    </th>
                    <th>
                        LASTNAME
                    </th>
                    <th>
                        ONLINE
                    </th>
                    <th>
                        TYPE
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($UsersList as $userFromUserList) {?>
                    <tr>
                        <td>
                            <?php
                            echo $userFromUserList->id;
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($userFromUserList == "admin") echo explode(" ", $userFromUserList->getName())[1];
                            else echo explode(" ", $userFromUserList->getName())[0];
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($userFromUserList == "admin") echo explode(" ", $userFromUserList->getName())[0];
                            else echo explode(" ", $userFromUserList->getName())[1];
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($userFromUserList->isActive) echo "Online";
                            else echo "Offline";
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $userFromUserList;
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html>

