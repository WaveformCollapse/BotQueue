<?php
/*
	This file is part of BotQueue.

	BotQueue is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	BotQueue is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with BotQueue.  If not, see <http://www.gnu.org/licenses/>.
  */


namespace App\Models\Observers;


use App\Models\Queue;
use Auth;

class QueueObserver
{

	/**
	 * @param Queue $queue
	 * @return bool
	 */
	public function creating($queue)
	{
		if($queue->delay == '') {
            $queue->delay = 0;
        }
		// The user must be logged in to create a queue
		if(Auth::check()) {
			$queue->user()->associate(Auth::user());
			return true;
		}
		return false;
	}
}