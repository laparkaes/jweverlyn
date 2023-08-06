<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		$this->load->view('home');
	}
	
	public function send_email(){
		$name = $this->input->post('name');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$message = $this->input->post('message');
		
		$content = "<table>";
		$content = $content.'<tr><td><strong>Nombre</strong></td><td>'.$name.'</td></tr>';
		$content = $content.'<tr><td><strong>Celular</strong></td><td>'.$mobile.'</td></tr>';
		$content = $content.'<tr><td><strong>Email</strong></td><td>'.$email.'</td></tr>';
		$content = $content.'<tr><td colspan="2"><strong>Mensaje</strong></td></tr><tr><td colspan="2">'.nl2br($message)."</td></tr>";
		$content = $content."</table>";
		
		$this->load->library('email');
		$config = [
            'protocol' => 'smtp', // 이메일 전송 방법 (smtp, mail, sendmail)
            'smtp_host' => 'jweverlyn.com', // SMTP 호스트 주소
            'smtp_port' => '465', // SMTP 포트 번호
            'smtp_user' => 'contacto@jweverlyn.com', // 발송자 이메일 계정
            'smtp_pass' => 'wjddn0915!', // 발송자 이메일 계정 비밀번호
			'smtp_crypto' => 'ssl', // 암호화
            'mailtype' => 'html', // 이메일 타입 (text 또는 html)
            'charset' => 'utf-8', // 문자셋
            'wordwrap' => TRUE, // 자동 줄바꿈 사용 여부
			'crlf' => "\r\n", // 줄바꿈 문자
			'newline' => "\r\n", // 줄바꿈 문자
        ];
		
		$this->email->initialize($config); // 이메일 설정을 초기화합니다.
		$this->email->from($email, $name); // 발송자 이름
        $this->email->to('contacto@jweverlyn.com'); // 수신자 이메일 주소
        $this->email->subject('Nuevo mensaje desde '.$name); // 이메일 제목
        $this->email->message($content); // 이메일 내용
		
		// 이메일을 발송합니다.
        if ($this->email->send()) echo "ok";
		else echo "";
		//show_error($this->email->print_debugger());
	}
}
