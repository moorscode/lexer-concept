<?php

namespace Moorscode\Lexer;

/**
 * Class Observer
 */
class Interpeter implements InterpeterInterface {

	/**
	 * @param Result $result
	 * @param string $identifier
	 */
	public function parse( Result $result, $identifier ) {

		// Run

		// Trigger ?

	}

	/**
	 * Start the batch
	 *
	 * @return string Batch Identifier
	 */
	public function begin() {
		$identifier = uniqid();

		// Trigger start

		return $identifier;
	}

	/**
	 * Finish the batch
	 *
	 * @param $identifier
	 *
	 * @return mixed
	 */
	public function end( $identifier ) {
		// Trigger end
	}
}
