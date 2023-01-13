<?php

namespace App\DTO;

class SeriesCreateFormInput
{
	public function __construct(
		public string $seriesName = '',
		public int $seasonsQuantity = 0,
		public int $episodesPerSeason = 0,
	){
	}
}
