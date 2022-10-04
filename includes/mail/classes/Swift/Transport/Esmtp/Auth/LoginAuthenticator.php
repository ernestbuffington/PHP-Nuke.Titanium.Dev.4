<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//@require 'Swift/Transport/Esmtp/Authenticator.php';
//@require 'Swift/Transport/SmtpAgent.php';
//@require 'Swift/TransportException.php';

/**
 * Handles LOGIN authentication.
 * @package Swift
 * @subpackage Transport
 * @author Chris Corbyn
 */
class Swift_Transport_Esmtp_Auth_LoginAuthenticator
  implements Swift_Transport_Esmtp_Authenticator
{
  
  /**
   * Get the name of the AUTH mechanism this Authenticator handles.
   * @return string
   */
  public function getAuthKeyword()
  {
    return 'LOGIN';
  }
  
  /**
   * Try to authenticate the user with $pnt_username and $password.
   * @param Swift_Transport_SmtpAgent $phpbb2_agent
   * @param string $pnt_username
   * @param string $password
   * @return boolean
   */
  public function authenticate(Swift_Transport_SmtpAgent $phpbb2_agent,
    $pnt_username, $password)
  {
    try
    {
      $phpbb2_agent->executeCommand("AUTH LOGIN\r\n", array(334));
      $phpbb2_agent->executeCommand(sprintf("%s\r\n", base64_encode($pnt_username)), array(334));
      $phpbb2_agent->executeCommand(sprintf("%s\r\n", base64_encode($password)), array(235));
      return true;
    }
    catch (Swift_TransportException $e)
    {
      $phpbb2_agent->executeCommand("RSET\r\n", array(250));
      return false;
    }
  }
  
}
