<?php

namespace Moorscode\Lexer;

/**
 * Class Lexer
 */
class Lexer implements LexerInterface {
	/**
	 * @var array
	 */
	private $terminals = array(
		'T_ROOT'            => 'root',
		'T_MAP'             => 'map',
		'T_WHITESPACE'      => '\s+',
		'T_URL'             => '\/[A-Za-z0-9\/:]+[^\s]',
		'T_BLOCKSTART'      => '->',
		'T_DOUBLESEPERATOR' => '::',
		'T_IDENTIFIER'      => '\w+',
	);

	/**
	 * @param $identifier
	 * @param $match
	 *
	 * @throws \InvalidArgumentException
	 */
	public function registerTerminal( $identifier, $match ) {
		if ( isset( $this->terminals[ $identifier ] ) ) {
			throw new \InvalidArgumentException( sprintf( 'Terminal %s has already been registered.', $identifier ) );
		}

		$this->terminals[ $identifier ] = $match;
	}

	/**
	 * @param array $source
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function run( $source ) {
		$results = array();

		foreach ( $source as $number => $line ) {

			$result = new Result();

			$line = trim( $line );

			while ( ! empty( $line ) ) {
				$match = $this->match( $line );
				if ( $match === false ) {
					throw new \Exception( "Unable to parse line " . ( $number + 1 ) . "." );
				}

				$result->add( $match );

				$line = substr( $line, strlen( current( $match ) ) );
			}

			$results[] = $result;
		}

		return $results;
	}

	/**
	 * @param $line
	 *
	 * @return array|bool
	 */
	private function match( $line ) {
		$parts = array_map( array( __CLASS__, 'buildRegEx' ),
			array_keys( $this->terminals ),
			$this->terminals );

		$full_regex = '/^' . implode( '|', $parts ) . '/';

		if ( preg_match_all( $full_regex, $line, $matches, PREG_SET_ORDER ) ) {
			foreach ( $matches as $match ) {
				$found = array_pop( $match );

				$keys       = array_keys( $match );
				$identifier = array_pop( $keys );

				return array(
					$identifier => $found,
				);
			}
		}

		return false;
	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return string
	 */
	private static function buildRegEx( $key, $value ) {
		return sprintf( '(?<%s>%s)', $key, $value );
	}
}
