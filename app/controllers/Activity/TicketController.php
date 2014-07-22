<?php

class TicketController extends ActivityController
{
	public $ticketService;

	public function __construct(TicketService $ticketService)
	{
        $this->ticketService = $ticketService;
        parent::__construct();
	}

    public function serviceName()
    {
        return 'ticketService';
    }
}