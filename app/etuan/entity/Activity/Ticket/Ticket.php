<?php
class TicketActivityInfo
{
	public $name;

	public $logo;

	public $theme;

	public $url;

	public $verify;

	public $ticket_waves;

	public function __construct($name, $logo, $theme, $url, $verify, $ticket_waves)
	{
		$this->name = $name;

		$this->logo = $logo;

		$this->theme = $theme;

		$this->url = $url;

		$this->verify = $verify;

		$this->ticket_waves = $ticket_waves;
	}
}
