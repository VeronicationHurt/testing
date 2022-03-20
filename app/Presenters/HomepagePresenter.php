<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Mail\Message;
use Nette\Mail\Mailer;

final class HomepagePresenter extends Nette\Application\UI\Presenter
{


    protected function createComponentCommentForm(): Form
    {
        $form = new Form;
    
    
        $form->addEmail('email', 'E-mail:');
    
        $form->addTextArea('content', 'Komentář:')
            ->setRequired();
    
        $form->addSubmit('send', 'Pošli si mail');
        $form->onSuccess[] = [$this, 'commentFormSucceeded'];
        return $form;
    }


    
    public function commentFormSucceeded(\stdClass $data): void
    {   $mailer = new Nette\Mail\SendmailMailer;
        
                   /** @var Message $message */
                   $message = new Message();
        
        $params = [
            'orderId' => 123,
        ];
      
        $message->setFrom('veronicationhurt@gmail.com')
            ->addTo($data->email)
            ->setSubject('Testing')
            ->setHtmlBody('<p>Hello there,</p><p>lorem impsum.</p><p>You sent: '. $data->content);

            $mailer->send($message);
    
    
        $this->flashMessage('Odeslalo se', 'success');
       
    }
}
