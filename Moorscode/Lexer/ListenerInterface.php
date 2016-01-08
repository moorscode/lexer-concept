<?php

namespace Moorscode\Lexer;

/**
 * Interface ListenerInterface
 */
interface ListenerInterface {
	/**
	 * @param Result $result
	 *
	 * @return void
	 */
	public function handle( Result $result );
}
