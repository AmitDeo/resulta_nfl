<?php

namespace Drupal\resulta_nfl\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\resulta_nfl\Controller\NFLController;

/**
 * Provides a 'NFL  Team List' Block.
 *
 * @Block(
 *   id = "resulta_nfl_nfl_block",
 *   admin_label = @Translation("NFL  Team List block"),
 *   category = @Translation("Resulta NFL"),
 * )
 */
class NFLBlock extends BlockBase {

  /**
   * {@inheritdoc}
   * The block required method to output the content
   */
  	public function build() {

	  	return array(
	      '#markup' => $this->_buildTeam(),
	      '#attached' => array(
	      	'library' => array('resulta_nfl/team-list')),
	    );
	}

	/*
	*  To bust the cache because the data may change on API url.
	*/
	public function getCacheMaxAge() {
	    return 0;
	}

	/*
	* Utility function to get the list in proper formatting
	*/
	private function _buildTeam()
	{
		$nflObj = new NFLController();
		$teams = $nflObj->getTeamList();

		$renderable = [
            '#theme' => 'teamlist-template',
            '#teams' => $teams
        ];

       	return \Drupal::service('renderer')->render($renderable);
	}
}