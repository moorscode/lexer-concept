<?php

namespace Moorscode\Lexer;

interface InterpeterInterface {

	/**
	 * Start the batch
	 *
	 * @return string Batch Identifier
	 */
	public function begin();

	/**
	 * Finish the batch
	 *
	 * @param $identifier
	 *
	 * @return mixed
	 */
	public function end( $identifier );

	/**
	 * Parse a line in a batch.
	 *
	 * @param Result $result
	 * @param string $identifier Batch Identifier
	 *
	 * @return
	 */
	public function parse( Result $result, $identifier );
}