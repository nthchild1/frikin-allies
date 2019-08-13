<?php
/**
 * Class responsible for scheduling and un-scheduling events (cron jobs).
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Frikin_Allies
 * @subpackage Frikin_Allies/includes
 */
 /**
 * Class responsible for scheduling and un-scheduling events (cron jobs).
 *
 * This class defines all code necessary to schedule and un-schedule cron jobs.
 *
 * @since      1.0.0
 * @package    Frikin_Allies
 * @subpackage Frikin_Allies/includes
 * @author     Frik-in <webmaster@frik-in.com>
 */
class Frikin_Allies_Cron {
 	const FRIKIN_ALLIES_EVENT_DAILY_HOOK = 'frikin_allies_event_daily';
 	/**
	 * Check if already scheduled, and schedule if not.
	 */
	public static function schedule() {
		if ( ! self::next_scheduled_daily() ) {
			self::daily_schedule();
		}
	}
 	/**
	 * Unschedule.
	 */
	public static function unschedule() {
		wp_clear_scheduled_hook( self::FRIKIN_ALLIES_EVENT_DAILY_HOOK );
	}
 	/**
	 * @return false|int Returns false if not scheduled, or timestamp of next run.
	 */
	private static function next_scheduled_daily() {
		return wp_next_scheduled( self::FRIKIN_ALLIES_EVENT_DAILY_HOOK );
	}
 	/**
	 * Create new schedule.
	 */
	private static function daily_schedule() {
		wp_schedule_event( time(), 'None' , self::FRIKIN_ALLIES_EVENT_DAILY_HOOK );
	}
}
