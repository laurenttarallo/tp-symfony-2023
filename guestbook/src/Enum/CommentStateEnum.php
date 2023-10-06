<?php

namespace App\Enum;

enum CommentStateEnum : string

{
case SUBMITTED = 'submitted';
case PUBLISHED = 'published';
case SPAM = 'spam';
}