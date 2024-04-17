<?php

namespace Elgg\Cli;

use Elgg\Logger\ElggLogFormatter;
use Monolog\Logger;
use Monolog\LogRecord;
use Symfony\Component\Console\Helper\FormatterHelper;

/**
 * Format errors for console output
 */
class ErrorFormatter extends ElggLogFormatter {

	const SIMPLE_FORMAT = '%level_name%: %message%';

	/**
	 * {@inheritdoc}
	 */
	public function format(LogRecord $record): string {
		$message = parent::format($record);

		$formatter = new FormatterHelper();

		switch ($record->level->value) {
			case Logger::EMERGENCY:
			case Logger::CRITICAL:
			case Logger::ALERT:
			case Logger::ERROR:
				$style = 'error';
				break;

			case Logger::WARNING:
				$style = 'comment';
				break;

			default:
				$style = 'info';
				break;
		}

		return $formatter->formatBlock($message, $style);
	}
}
