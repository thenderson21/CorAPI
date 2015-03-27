<?php
/**
 * Exception Handeling class file.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id$
 * @since 10/19/12
 * @package CoreAPI/ExceptionHandling
 */

/**
 * Class for handeling exceptions.
 *
 * The ExceptionHandler class contains standardised methods for processing caught exceptions.
 *
 * @package CoreAPI/ExceptionHandling 
 * @todo Bring up to current coding standards. 
 */
class ExceptionHandler {
	/**
	 * ERROR_EMAIL
	 *
	 * The email address used to send exception to, when the email option is set.
	 * @todo Move ERROR_EMAIL to Constants class and create a local varriable.
	 */
	const ERROR_EMAIL = 'webprod@spe.org'; //Default email to send error message to

	//This function handles exception that are passed to it depending on varriable passed.
	/**
	 * ExceptionHandler::exception(object $exception, string $action).
	 *
	 * The ExceptioHandler class provides a standardised way for handeling exception. Exceptions
	 * are handled by puting them in the php log 'log', emailing then to the email address stored
	 * in ERROR_EMAIL 'email', or by printing them to the screen 'echo'.
	 *
	 * <b>Example:</b><br>
	 * <code>{.php}
	 * try{
	 *  if(false){
	 *  throw new Exception('False is still false.');
	 * }
	 * }catch( Exception $someException ){
	 *  ExceptionHandler::handle($someException, 'log');
	 * }
	 * </code>
	 * 
	 * @static
	 * @param object $exception
	 * @param string $action (default: 'log')
	 * @return void
	 */
	public static function handle( $exception, $action='log' ) {
		$argv = func_get_args();
		$exception = $argv[0];
		$action =  $argv[1];

		switch ( func_num_args() ) {
		case '0':
			error_log('Missing or invalid arguments.', 0);
			echo 'Missing or invalid arguments.';
			die;

		case '1':
			//Minumum arguments and default action
			if ( is_string( $exception ) ) {
				error_log($exception, 0);   //Write error to log;
				return true;

			}elseif ( is_object( $exception ) ) {
				error_log( $exception->getMessage(), 0 );   //Write error to log;
				return true;
			}
			else {
				error_log('Missing or invalid arguments.', 0);
				die;
			}

		case '2':
			if (  is_object( $exception  ) &&  is_string( $action ) ) {
				switch ( $action) {
				case 'log':
					error_log($exception->getMessage(), 0);   //Write error to log;
					return true;

				case 'email':
					error_log( $exception->getMessage(), 1, self::ERROR_EMAIL );
					return true;

				case 'echo':
					echo '<div style="background-color:red;color:yellow;"><strong>Uncaught Exception</strong>: '.$argv[0]->getTraceAsString().'</br>'.$argv[0]->getMessage().'</div>';
					return true;

				default:
					error_log($exception, 0);   //Write error to log;
					return true;
				}
			}elseif (!is_object( $exception ) ) {
				error_log($exception.'In not a valid object.', 0);
				die;
			}else {
				error_log('Missing or invalid arguments.', 0);
				die;
			}
			break;
		}
	}//end esception()
}//end class