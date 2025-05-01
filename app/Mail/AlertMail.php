<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $loginname;
    public $companyname;
    public $viewid;
    public $putnumber;

    public function __construct($loginname, $companyname, $viewid, $putnumber)
    {
        $this->loginname = $loginname;
        $this->companyname = $companyname;
        $this->viewid = $viewid;
        $this->putnumber = $putnumber;
    }

    // public function build()
    // {
    //     return $this->view('emails.alert')
    //         ->subject('Limit Reached')
    //         ->with([
    //             'loginname' => $this->loginname,
    //             'companyname' => $this->companyname,
    //             'viewid' => $this->viewid,
    //             'putnumber' => $this->putnumber,
    //         ]);
    // }
    public function build()
{
    return $this->view('emails.alert')
        ->subject('Limit Reached');
}
}