<?php

interface UserHandleInterface
{
	public function login($email,$password);

	public function logout();

	public function register($email,$password);

	public function changePassword($oldPassword,$newPassword);
}