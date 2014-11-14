<?php

class VoteActivitySeeder extends Seeder {

	/**
	 * Run the VoteActivity seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$vote_id = Vote::insertGetId(array(
			'name' => 'test',
			'start_time' => '2014-11-13 00:00:00',
			'stop_time' => '2014-11-15 00:00:00',
			'theme' => 1,
			'limit_grade' => '11111',
			'choice_num' => 2,
			'org_uid' => 1
			));
		for($i=0;$i<3;$i++)
		{
			Vote_item::insert(array(
				'label' => "物品{$i}",
				'vote_count' => 0,
				'vote_id' => $vote_id
				));
		}
	}

}
