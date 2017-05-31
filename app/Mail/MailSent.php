<?php

namespace App\Mail;

use Mail;

/**
* 
*/
class MailSent 
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }
	public function SentMailGroupbuyRemind(
		$email_text,
    	$email_title,
    	$email_addresse
    ){
		Mail::send('email.GroupbuyRemind',['mail_text'=>$email_text],function ($message) use ($email_title, $email_addresse){
	    	$message->subject($email_title);
	    	$message->to($email_addresse);
	    });
    }
	
	public static function Static_SentMailGroupbuyRemind(
		$email_text,
    	$email_title,
    	$email_addresse
    ){
		Mail::send('email.GroupbuyRemind',['mail_text'=>$email_text],function ($message) use ($email_title, $email_addresse){
	    	$message->subject($email_title);
	    	$message->to($email_addresse);
	    });
    }

    public function SentMailInsertUser(
    	$email_Name,
    	$email_ID,
    	$email_addresse
    ){
		Mail::send('email.InsertUser',['mail_text'=>$email_ID],function ($message) use ( $email_addresse){
	    	$message->subject('申請通過');
	    	$message->to($email_addresse);
	    });
    }
    public function SendAllEmail(
    	$email_Name,
        $email_ID,
        $email_addresse,
        $email_content
    ){
    	Mail::send('email.Notice',['email_ID'=>$email_ID,'email_content'=>$email_content],function ($message) use ( $email_addresse){
	    	$message->subject('藍星購物網通知');
	    	$message->to($email_addresse);
	    });
    }
}
?>