<?php

namespace Moorscode\Lexer;

/**
 * Class Observer
 */
class Observer {
	/**
	 * @var array
	 */
	private static $listeners = array();

	/**
	 * @param $listener
	 * @param string|array $tokens_hash
	 */
	public static function addListener( ListenerInterface $listener, $tokens_hash ) {
		if ( is_array( $tokens_hash ) ) {
			$tokens_hash = Result::generateHash( $tokens_hash );
		}

		self::$listeners[ $tokens_hash ][] = $listener;
	}

	/**
	 * @param Result $result
	 */
	public function handle( Result $result ) {
		$hash = $result->getTokensHash();

		if ( empty( self::$listeners[ $hash ] ) ) {
			return;
		}

		array_walk( self::$listeners[ $hash ],
			function ( $listener ) use ( $result ) {
				$listener->handle( $result );
			}
		);
	}
}
