<?php
/**
 * Message class file.
 *
 * @link https://github.com/thenderson21/CorAPI/
 * @copyright Copyright © 2013 Todd Henderson
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Todd Henderson <todd@todd-henderson.me>
 * @version $Id
 * @since 10/11/12
 * @package CoreAPI/ExceptionHandling
 */


/**
 * Class for handeling non-crucial messages.
 *
 * This is the class file for the Message class.  The message class
 * is intended as a tool for gathering and refrencing message to the site adminPage.class.php
 * without throwing and exception and stoping the code. Messages would be used when
 * some action need to be taked but, the public user does not need to see the message.
 *
 * @uses ExceptionHandler
 * @package CoreAPI/ExceptionHandling
 * @todo Bring up to current coding standards. 
 */
class Message {
	/**
	 * Message::$warnings
	 *
	 * The $warnings varriable is an array that contains each warning. Warnings
	 * are objects that contains a 'message' property and may contain other useful
	 * information attached.
	 *
	 * @var array 
	 * @static
	 */
	static $warnings;
	/**
	 * Message::$notices
	 *
	 * The $notices varriable is an array that contains each notice. Notices
	 * are objects that contains a 'message' property and may contain other useful
	 * information attached.
	 * @var array 
	 * @static
	 */
	static $notices;

	/** Message::DEFAULT_TYPE
	 *
	 * The default type of message.
	 */
	const DEFAULT_TYPE = 'warning';


	/**
	 * Message::listTypes
	 *
	 * Contains an array of acceptable types: array( 'warning', 'notice' ).
	 *
	 * @var array
	 * @access private
	 */
	private $listTypes = array( 'warning', 'notice' );



	/**
	 * Message::__construct
	 *
	 * Constructs a Message object. 
	 * @param string $message
	 * @param string $type (default: DEFAULT_TYPE)
	 * @return bool Returns <b>true</b> on sucessful instanciation or throws an exception.
	 */
	function __construct( $message, $type = DEFAULT_TYPE ) {
		$argv = func_get_args();
		$message = $argv[0];
		$type = $argv[1];

		switch ( func_num_args() ) {
		case 1;
			switch ( self::DEFAULT_TYPE ) {
			case 'warning':
				self::$warnings[] = (object) array( 'message'=> $message );
				return true;

			case 'notice':
				self::$notices[] = (object) array( 'message'=> $message );
				return true;

			default:
				throw new Exception('Missing or invalid argument.');
			}

		case 2:
			if ( is_string( $message) && in_array( $type , $this->listTypes ) ) {
				switch ( $type  ) {
				case 'warning':
					self::$warnings[] = (object) array( 'message'=> $message );
					return true;

				case 'notice':
					self::$notices[] = (object) array( 'message'=> $message );
					return true;
				}
			}elseif ( is_string( $message) && !in_array( $type, $this->listTypes )  ) {
				throw new Exception('Unexpected type: '.$type.'.');
			}elseif ( !is_string( $message ) ) {
				throw new Exception('Expecting string got: '.gettype( $message ).'.');
			}
		}
	}// __construct()

	/**
	 * Message::printWarnings
	 *
	 * Prints all warnings in an individual <i>div</i> blocks. 
	 * @return void
	 */
	public function printWarnings() {
		if ( count( self::$warnings ) > 0 ) {
			foreach ( self::$warnings as $key=>$value ) {
				if ($key == 0) {
					echo "\n".'<div style="background-color:yellow;color:red;"><strong>Warning:</strong> '.$value->message.'</div>';
				}else {
					echo "\n".'<div style="background-color:yellow;color:red;"><strong>Warning['.$key.']:</strong> '.$value->message .'</div>';
				}
			}
		}
	}// end printWarnings()

	//
	/**
	 * Message::logWarnings
	 *
	 * Sends all warnings to the php log via ExceptionHandler.
	 * @uses ExceptionHandler 
	 * @return void
	 */
	public function logWarnings() {
		if ( count( self::$warnings ) > 0 ) {
			foreach ( self::$warnings as $key=>$value ) {
				if ($key == 0) {
					ExceptionHandler::exception( 'Warning: '.$value->message, 'log' );
				}else {
					ExceptionHandler::exception( 'Warning['.$key.']: '.$value->message, 'log' );
				}
			}
		}
	}// end logWarnings()


	/**
	 * Message::emailWarnings
	 *
	 * Sends all warnings to the admin via an email through ExceptionHandler.
	 * @uses ExceptionHandler 
	 * @return void
	 */
	public function emailWarnings() {
		if ( count( self::$warnings ) > 0 ) {
			foreach ( self::$warnings as $key=>$value ) {
				if ($key == 0) {
					ExceptionHandler::exception( 'Warning: '.$value->message, 'email' );
				}else {
					ExceptionHandler::exception( 'Warning['.$key.']: '.$value->message, 'email' );
				}
			}
		}
	}// end emailWarnings()

	/**
	 * Message::printNotices
	 *
	 * Prints all notices in an individual <i>div</i> block. 
	 * @return void
	 */
	public function printNotices() {
		if ( count( self::$notices ) > 0 ) {
			foreach ( self::$notices as $key=>$value ) {
				if ($key == 0) {
					echo "\n".'<div style="background-color:white;color:red;"><strong>Notice:</strong> '.$value->message.'</div>';
				}else {
					echo "\n".'<div style="background-color:white;color:red;"><strong>Notice['.$key.']:</strong> '.$value->message.'</div>';
				}
			}
		}
	}// end printNotices()

	//
	/**
	 * Message::logNotices
	 *
	 * Sends all notices to the php log via ExceptionHandler.
	 * @uses ExceptionHandler 
	 * @return void
	 */
	public function logNotices() {
		if ( count( self::$notices ) > 0 ) {
			foreach ( self::$notices as $key=>$value ) {
				if ($key == 0) {
					ExceptionHandler::exception( 'Notice: '.$value->message, 'log' );
				}else {
					ExceptionHandler::exception( 'Notice['.$key.']: '.$value->message, 'log' );
				}
			}
		}
	}// end logNotices()

	/**
	 * Message::emailNotices
	 *
	 * Sends all notices to the admin via an email through ExceptionHandler.
	 * @uses ExceptionHandler 
	 * @return void
	 */
	public function emailNotices() {
		if ( count( self::$notices ) > 0 ) {
			foreach ( self::$notices as $key=>$value ) {
				if ($key == 0) {
					ExceptionHandler::exception( 'Notice: '.$value->message, 'email' );
				}else {
					ExceptionHandler::exception( 'Notice['.$key.']: '.$value->message, 'email' );
				}
			}
		}
	}// end emailNotices()

	//
	/**
	 * Message::getLastWarningId
	 *
	 * Returns the index of the last warning that was created. 
	 * @return int|string Returns the index of the last warning that was created or <b>false</b> if none exist.
	 */
	public function getLastWarningId() {
		if ( is_array( self::$warnings ) ) {
			return key( array_slice( self::$warnings, -1, 1, TRUE ) );
		}else {
			return false;
		}
	}

	/**
	 * Message::getLastNoticeId
	 *
	 * Returns the index of the last notice that was created. 
	 * @return int|string Returns the index of the last notice that was created or <b>false</b> if none exist.
	 */
	public function getLastNoticeId() {
		if ( is_array( self::$notices ) ) {
			return key( array_slice( self::$notices , -1, 1, TRUE ) );
		}else {
			return false;
		}
	}

	/**@todo Add a popup window optopn to the message object. */
	/*
		public function addPopUp( $urlOrHTML ){
			if(  ){

			}
		}
*/
}//end class


?>