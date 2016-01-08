<?php

namespace Moorscode\Lexer;

/**
 * Class LexerResult
 */
class Result {
	/**
	 * @var array
	 */
	private $parts = array();

	/**
	 * @var bool
	 */
	private $hash = false;

	/**
	 * @param $part
	 */
	public function add( $part ) {
		$this->parts[] = $part;
		$this->hash    = false;
	}

	/**
	 * @return array
	 */
	public function get() {
		return $this->parts;
	}

	/**
	 * @return array
	 */
	public function getMatches() {
		return array_map( array( __CLASS__, 'buildMatches' ), $this->parts );
	}

	/**
	 * @return array
	 */
	public function getTokens() {
		return array_map( array( __CLASS__, 'buildTokens' ), $this->parts );
	}

	/**
	 * @return bool|string
	 */
	public function getTokensHash() {
		if ( false === $this->hash ) {
			$this->hash = self::generateHash( $this->getTokens() );
		}

		return $this->hash;
	}

	/**
	 * @param $item
	 *
	 * @return mixed
	 */
	private function buildMatches( $item ) {
		return current( $item );
	}

	/**
	 * @param $item
	 *
	 * @return mixed
	 */
	private function buildTokens( $item ) {
		return key( $item );
	}

	/**
	 * @param $tokens
	 *
	 * @return string
	 */
	public static function generateHash( $tokens ) {
		$string = implode( '|', $tokens );
		$hash = hash( 'md4', $string );

		return $hash;
	}
}
