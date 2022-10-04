<?php

/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//@require 'Swift/Transport/SmtpAgent.php';

/**
 * An Authentication mechanism.
 * @package Swift
 * @subpackage Transport
 * @author Chris Corbyn
 */
interface Swift_Transport_Esmtp_Authenticator
{
  
  /**
   * Get the name of the AUTH mechanism this Authenticator handles.
   * @return string
   */
  public function getAuthKeyword();
  
  /**
   * Try to authenticate the user with $pnt_username and $password.
   * @param Swift_Transport_SmtpAgent $phpbb2_agent
   * @param string $pnt_username
   * @param string $password
   * @return boolean
   */
  public function authenticate(Swift_Transport_SmtpAgent $phpbb2_agent,
    $pnt_username, $password);
  
}
