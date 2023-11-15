<?php

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Support\Facades\Mail;

####_____________

function userCount()
{
    return count(User::all()) + 1;
}

function Custom_Timestamp()
{
    $date = new DateTimeImmutable();
    $micro = (int)$date->format('Uu'); // Timestamp in microseconds
    return $micro;
}

function Send_Email($email, $subject, $message)
{
    $data = [
        "subject" => $subject,
        "message" => $message,
    ];
    Mail::to($email)->send(new SendEmail($data));
}

function Send_Notification($receiver, $subject, $message)
{
    $data = [
        "subject" => $subject,
        "message" => $message,
    ];
    Notification::send($receiver, new SendNotification($data));
}


#######_____________

###__CE HELPER PERMET DE VERIFIER SI UN UTILISATEUR EST UN VENDEUR OU PAS
function Is_User_A_Vendor($userId)
{
    $user = User::find($userId);
    if (!$user) {
        return false;
    }

    if ($user->type != 1) {
        return false;
    }

    return true;
}

###__CE HELPER PERMET DE VERIFIER SI UN UTILISATEUR EST UN ACHETEUR OU PAS
function Is_User_A_Buyer($userId)
{
    $user = User::find($userId);
    if (!$user) {
        return false;
    }

    if ($user->type != 2) {
        return false;
    }

    return true;
}
