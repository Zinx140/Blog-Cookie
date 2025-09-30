<?php

function isUsernameTaken($users, $username)
{
    foreach ($users as $user) {
        if ($user["username"] == $username) {
            return false;
        }
    }
    return true;
}

function findUser($users, $username)
{
    foreach ($users as $user) {
        if ($user["username"] == $username) {
            return $user;
        }
    }
    return null;
}

function maxID($blogs)
{
    $max_id = 0;
    foreach ($blogs as $blog) {
        if ($blog["id"] > $max_id) {
            $max_id = $blog["id"];
        }
    }
    return $max_id;
}

function hasUp($blogs, $blog_id, $username)
{
    foreach ($blogs as $blog) {
        if ($blog["id"] == $blog_id) {
            foreach ($blog['up'] as $up) {
                if ($up == $username) {
                    return true;
                }
            }
            break;
        }
    }
    return false;
}
