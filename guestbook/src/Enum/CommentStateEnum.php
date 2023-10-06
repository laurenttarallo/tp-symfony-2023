<?php

namespace App\Enum;

enum CommentStateEnum : string

{
case SUBMITTED = 'submitted';
case PUBLISHED = 'published';
case SPAM = 'spam';
case HAM = 'ham';
case POTENTIAL_SPAM = 'potential_spam';
case REJECTED = 'rejected';

}