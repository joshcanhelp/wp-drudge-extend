<?php


final class PccWpCliAddOns extends WP_CLI_Command {

	/*
	 * Generates dummy content in your WordPress database.
	 * Still in beta, has only been used once or twice ... won't harm anything but might want to
	 * continue forever :) use CTRL + C to stop
	 */

	public function generate ( $args = array(), $assoc_args = array() ) {

		WP_CLI::line( 'Starting...' );

		// Users for comments and content
		$users = get_users();
		$user_ids = array();
		foreach ( $users as $user ) {
			$user_ids[] = $user->data->ID;
		}

		// Featured image attachments
		$attachments = get_posts( array(
			'post_type' => 'attachment',
			'posts_per_page' => -1,
			'post_mime_type' => 'image'
		) );

		$image_cats = array( 'abstract', 'city', 'people', 'transport', 'animals', 'food', 'nature',
			'business', 'nightlife', 'sports', 'cats', 'fashion', 'technics');

		$cat_count = 0;

		// Args
		$post_type = 'post';
		$status = 'publish';
		$number = ! empty( $assoc_args['num'] ) ? (int) $assoc_args['num'] : 100;

		for ( $i = 1; $i <= $number; $i++ ) {

			$author_id = $user_ids[ mt_rand( 0, count( $user_ids ) - 1 ) ];

			$title = $this->generate_title();
			$content = $this->get_text();

			$pid = wp_insert_post( array(
				'post_title'   => $title,
				'post_status'  => $status,
				'post_type'    => $post_type,
				'post_excerpt' => 'Content: ' . $content,
				'post_content' => 'Excerpt: ' .$content,
				'post_author' => $author_id
			) );

			// Meta fields
			update_post_meta( $pid, 'link', $this->random_url() );
			update_post_meta( $pid, 'blurb', 'Blurb: ' . $content );

			// Image from different place


			switch ( mt_rand( 0, 5 ) ) {
				case 1:
					update_post_meta( $pid, 'image', 'http://lorempixel.com/400/300/' . $image_cats[ $cat_count ] );

					break;
				case 2:
					update_post_meta( $pid, 'wpd_video', $this->random_embed() );
					break;
				case 3:
					update_post_meta(
						$pid,
						'_thumbnail_id',
						$attachments[ mt_rand( 0, count( $attachments ) - 1 ) ]->ID
					);
					break;
			}

			$cat_count ++;
			if ( $cat_count === count( $image_cats ) ) {
				$cat_count = 0;
			}


			// Image from different place
			switch ( mt_rand( 0, 10 ) ) {
				case 1:
					update_post_meta( $pid, 'wpd_italic', 1 );
					break;
				case 2:
					update_post_meta( $pid, 'border', 1 );
					break;
				case 3:
					update_post_meta( $pid, 'color', 'ff000' );
					break;
			}


			// Taxonomies
			$pl_cats = array( 193, 194, 195 );
			wp_set_post_terms( $pid, $pl_cats[ mt_rand( 0, 2 ) ], 'category' );

			// Comments
			$comment_no = mt_rand( 1 , 10 );
			for ( $i = 1; $i <= $comment_no; $i++ ) {

				$rand_user = $users[ mt_rand( 0, count( $users ) - 1 ) ];

				$cid = wp_insert_comment( array(
					'comment_post_ID'      => $pid,
					'comment_author'       => $rand_user->data->display_name,
					'comment_author_email' => $rand_user->data->user_email,
					'comment_author_url'   => '',
					'comment_content'      => $this->generate_title(),
					'comment_type'         => '',
					'comment_parent'       => 0,
					'user_id'              => $rand_user->data->ID,
					'comment_date'         => current_time( 'mysql' ),
					'comment_approved'     => 1,
				) );

				add_user_meta( $rand_user->data->ID, 'wpri_vote_comment', $cid );
				update_comment_meta( $cid, 'wpri_upvotes', mt_rand( 1, 10 ) );
			}

			WP_CLI::line( 'Added "' . $title . '" with ' . $comment_no . ' comments' );

		}

	}

	private function generate_title () {

		// Generated content
		$title_nouns = array(
			"Dream",
			"Dreamer",
			"Dreams",
			"Waves",
			"Sword",
			"Kiss",
			"Sex",
			"Lover",
			"Slave",
			"Slaves",
			"Pleasure",
			"Servant",
			"Servants",
			"Snake",
			"Soul",
			"Touch",
			"Men",
			"Women",
			"Gift",
			"Scent",
			"Ice",
			"Snow",
			"Night",
			"Silk",
			"Secret",
			"Secrets",
			"Game",
			"Fire",
			"Flame",
			"Flames",
			"Husband",
			"Wife",
			"Man",
			"Woman",
			"Boy",
			"Girl",
			"Truth",
			"Edge",
			"Boyfriend",
			"Girlfriend",
			"Body",
			"Captive",
			"Male",
			"Wave",
			"Predator",
			"Female",
			"Healer",
			"Trainer",
			"Teacher",
			"Hunter",
			"Obsession",
			"Hustler",
			"Consort",
			"Dream",
			"Dreamer",
			"Dreams",
			"Rainbow",
			"Dreaming",
			"Flight",
			"Flying",
			"Soaring",
			"Wings",
			"Mist",
			"Sky",
			"Wind",
			"Winter",
			"Misty",
			"River",
			"Door",
			"Gate",
			"Cloud",
			"Fairy",
			"Dragon",
			"End",
			"Blade",
			"Beginning",
			"Tale",
			"Tales",
			"Emperor",
			"Prince",
			"Princess",
			"Willow",
			"Birch",
			"Petals",
			"Destiny",
			"Theft",
			"Thief",
			"Legend",
			"Prophecy",
			"Spark",
			"Sparks",
			"Stream",
			"Streams",
			"Waves",
			"Sword",
			"Darkness",
			"Swords",
			"Silence",
			"Kiss",
			"Butterfly",
			"Shadow",
			"Ring",
			"Rings",
			"Emerald",
			"Storm",
			"Storms",
			"Mists",
			"World",
			"Worlds",
			"Alien",
			"Lord",
			"Lords",
			"Ship",
			"Ships",
			"Star",
			"Stars",
			"Force",
			"Visions",
			"Vision",
			"Magic",
			"Wizards",
			"Wizard",
			"Heart",
			"Heat",
			"Twins",
			"Twilight",
			"Moon",
			"Moons",
			"Planet",
			"Shores",
			"Pirates",
			"Courage",
			"Time",
			"Academy",
			"School",
			"Rose",
			"Roses",
			"Stone",
			"Stones",
			"Sorcerer",
			"Shard",
			"Shards",
			"Slave",
			"Slaves",
			"Servant",
			"Servants",
			"Serpent",
			"Serpents",
			"Snake",
			"Soul",
			"Souls",
			"Savior",
			"Spirit",
			"Spirits",
			"Voyage",
			"Voyages",
			"Voyager",
			"Voyagers",
			"Return",
			"Legacy",
			"Birth",
			"Healer",
			"Healing",
			"Year",
			"Years",
			"Death",
			"Dying",
			"Luck",
			"Elves",
			"Tears",
			"Touch",
			"Son",
			"Sons",
			"Child",
			"Children",
			"Illusion",
			"Sliver",
			"Destruction",
			"Crying",
			"Weeping",
			"Gift",
			"Word",
			"Words",
			"Thought",
			"Thoughts",
			"Scent",
			"Ice",
			"Snow",
			"Night",
			"Silk",
			"Guardian",
			"Angel",
			"Angels",
			"Secret",
			"Secrets",
			"Search",
			"Eye",
			"Eyes",
			"Danger",
			"Game",
			"Fire",
			"Flame",
			"Flames",
			"Bride",
			"Husband",
			"Wife",
			"Time",
			"Flower",
			"Flowers",
			"Light",
			"Lights",
			"Door",
			"Doors",
			"Window",
			"Windows",
			"Bridge",
			"Bridges",
			"Ashes",
			"Memory",
			"Thorn",
			"Thorns",
			"Name",
			"Names",
			"Future",
			"Past",
			"History",
			"Something",
			"Nothing",
			"Someone",
			"Nobody",
			"Person",
			"Man",
			"Woman",
			"Boy",
			"Girl",
			"Way",
			"Mage",
			"Witch",
			"Witches",
			"Lover",
			"Tower",
			"Valley",
			"Abyss",
			"Hunter",
			"Truth",
			"Edge"
		);

		$title_adj = array(
			"Lost",
			"Only",
			"Last",
			"First",
			"Third",
			"Sacred",
			"Bold",
			"Lovely",
			"Final",
			"Missing",
			"Shadowy",
			"Seventh",
			"Dwindling",
			"Missing",
			"Absent",
			"Vacant",
			"Cold",
			"Hot",
			"Burning",
			"Forgotten",
			"Weeping",
			"Dying",
			"Lonely",
			"Silent",
			"Laughing",
			"Whispering",
			"Forgotten",
			"Smooth",
			"Silken",
			"Rough",
			"Frozen",
			"Wild",
			"Trembling",
			"Fallen",
			"Ragged",
			"Broken",
			"Cracked",
			"Splintered",
			"Slithering",
			"Silky",
			"Wet",
			"Magnificent",
			"Luscious",
			"Swollen",
			"Erect",
			"Bare",
			"Naked",
			"Stripped",
			"Captured",
			"Stolen",
			"Sucking",
			"Licking",
			"Growing",
			"Kissing",
			"Green",
			"Red",
			"Blue",
			"Azure",
			"Rising",
			"Falling",
			"Elemental",
			"Bound",
			"Prized",
			"Obsessed",
			"Unwilling",
			"Hard",
			"Eager",
			"Ravaged",
			"Sleeping",
			"Wanton",
			"Professional",
			"Willing",
			"Devoted",
			"Misty",
			"Lost",
			"Only",
			"Last",
			"First",
			"Final",
			"Missing",
			"Shadowy",
			"Seventh",
			"Dark",
			"Darkest",
			"Silver",
			"Silvery",
			"Living",
			"Black",
			"White",
			"Hidden",
			"Entwined",
			"Invisible",
			"Next",
			"Seventh",
			"Red",
			"Green",
			"Blue",
			"Purple",
			"Grey",
			"Bloody",
			"Emerald",
			"Diamond",
			"Frozen",
			"Sharp",
			"Delicious",
			"Dangerous",
			"Deep",
			"Twinkling",
			"Dwindling",
			"Missing",
			"Absent",
			"Vacant",
			"Cold",
			"Hot",
			"Burning",
			"Forgotten",
			"Some",
			"No",
			"All",
			"Every",
			"Each",
			"Which",
			"What",
			"Playful",
			"Silent",
			"Weeping",
			"Dying",
			"Lonely",
			"Silent",
			"Laughing",
			"Whispering",
			"Forgotten",
			"Smooth",
			"Silken",
			"Rough",
			"Frozen",
			"Wild",
			"Trembling",
			"Fallen",
			"Ragged",
			"Broken",
			"Cracked",
			"Splintered"
		);

		$rand_adj = $title_adj[ mt_rand( 0, count( $title_adj ) - 1 ) ];
		$rand_noun = $title_nouns[ mt_rand( 0, count( $title_nouns ) - 1 ) ];
		$rand_noun2 = $title_nouns[ mt_rand( 0, count( $title_nouns ) - 1 ) ];

		switch ( mt_rand( 1, 6 ) ) {
			case 1:
				return $rand_adj . ' ' . $rand_noun . ' that uses ' . $rand_noun2;
			case 2:
				return 'The ' . $rand_adj . ' ' . $rand_noun;
			case 3:
				return $rand_noun . ' of ' . $rand_adj . ' ' . $rand_noun2;
			case 4:
				return 'The ' . $rand_noun . '\'s ' . $rand_noun2;
			case 5:
				return 'The ' . $rand_noun . ' of the ' . $rand_noun2;
			case 6:
				return $rand_noun2 . ' in the ' . $rand_noun;
		}
	}

	/*
	 * Generates a random, functioning URL with valid post IDs from 3 web properties
	 */

	private function random_url () {

		$proper_ids = array( '1859','1860','1861','1862','120','123','148','152','175','444','447','451','453','456','458','460','463','2021','2023','2301','2516','23','111','29','1863','4','5','6','7','13','15','38','40','54','66','1818','2334','2493','2495','2498','2507','2510','3649','3652','3651','3692','3787','3886','3889','3892','3878','3615','1779','1781','1786','2341','2368','2428','59','31','57','61','1796','1797','1813','1824','1839','2037','2292');

		$wpdrudge_ids = array('8', '18', '64', '66', '67', '68', '69', '71', '65', '74', '75', '76', '149501', '149603', '149642', '149694', '149706', '149825', '149827', '149829', '149831', '149846', '149849', '149851', '149853', '149855', '149858', '149876', '149880', '149983', '149993', '150045', '150035', '150120', '150254', '150256', '150258', '150263', '150265', '150281', '150293', '150319', '150557', '150597', '150942', '150959', '151265', '151370', '151372', '151375', '151377', '151380', '151411', '151408', '151413', '151499', '151513', '151696', '151149', '149466', '149634', '149687', '149909', '149974', '149963', '150088', '150126', '150248', '150372', '150402', '150509', '150530', '150670', '150851', '151002', '151151', '151236', '151253', '151294', '151303', '151527', '151584');

		$jch_ids = array('714', '756', '844', '849', '853', '1004', '1524', '1584', '1585', '1678', '2371', '2407', '2422', '2439', '2443', '2769', '2830', '2873', '838', '1036', '1228', '1300', '2241', '2360', '2653', '2737', '2740', '2745', '2750', '2754', '2763', '2765', '2768', '2772', '2781', '2785', '2802', '2826', '2835', '2839', '2908', '2970', '2989', '2995', '3007', '3056', '3712', '2418', '2610', '1753', '2359', '2329', '2325', '2497', '2533', '2647', '2686', '2599', '3685', '3701', '3708', '3093', '3094', '10', '11', '12', '15', '17', '21', '23', '25', '26', '28', '30', '32', '33', '37', '38', '41', '39', '40', '42', '67', '78', '75', '63', '173', '187', '189', '203', '207', '210', '235', '233', '254', '260', '273', '268', '281', '284', '277', '290', '317', '325', '334', '337', '351', '359', '356', '362', '366', '370', '380', '386', '400', '443', '447', '449', '451', '454', '459', '461', '467', '470', '477', '479', '484', '488', '497', '491', '517', '522', '529', '556', '573', '576', '580', '586', '619', '626', '636', '639', '647', '652', '662', '680', '699', '746', '786', '789', '796', '806', '816', '865', '871', '895', '906', '912', '926', '941', '973', '977', '983', '993', '1108', '1127', '1132', '1161', '1167', '1173', '1199', '1207', '1216', '1258', '1265', '1307', '1344', '1322', '1380', '1405', '1453', '1471', '1482', '1526', '1539', '1559', '1596', '2331', '1626', '1642', '2411', '1663', '1672', '1710', '1718', '2332', '1750', '1809', '1726', '1828', '2054', '2083', '2337', '2454', '2218', '2246', '2450', '2262', '1870', '2405', '2402', '2492', '2495', '2502', '2080', '2529', '2521', '2574', '2689', '2679', '2708', '2722', '2357', '2731', '2883', '2859', '2860', '2858', '3011', '3015', '2963', '3049', '3615', '3226', '3626', '3618', '3505', '3621', '3624', '3610', '3637', '3648', '3660', '3696', '3679', '3692', '3689', '8');

		switch ( mt_rand( 0, 4 ) ) {

			case 0:
				return 'https://theproperweb.com/?p=' . $proper_ids[ mt_rand( 0, count( $proper_ids ) - 1 ) ];

			case 1:
				return 'https://wpdrudge.com/?p=' . $wpdrudge_ids[ mt_rand( 0, count( $wpdrudge_ids ) - 1 ) ];

			case 2:
				return 'http://www.joshcanhelp.com/?p=' . $jch_ids[ mt_rand( 0, count( $jch_ids ) - 1 ) ];

		}
	}

	private function random_embed () {

		$urls = array(
			'https://www.youtube.com/watch?v=kw8pktuefG0',
			'https://www.youtube.com/watch?v=MepXBJjsNxs',
			'https://www.youtube.com/watch?v=mJ4iGE8Rgck',
			'https://www.youtube.com/watch?v=q5nVqeVhgQE',
			'https://www.youtube.com/watch?v=OHGt0_t7Heo',
			'https://www.youtube.com/watch?v=BONgL61snlM',
			'https://www.youtube.com/watch?v=9bZkp7q19f0',
			'https://www.youtube.com/watch?v=Pe0n5mqkf6c',
			'https://www.youtube.com/watch?v=RYlCVwxoL_g',
			'https://www.youtube.com/watch?v=LprA7Ypt-Xo',
			'https://www.youtube.com/watch?v=FTnkkMbbCH8',
			'https://www.youtube.com/watch?v=G-wxw_vxMcg',
			'https://www.youtube.com/watch?v=ZxUBI4e_X5c',
			'https://vimeo.com/127628756',
			'https://vimeo.com/126726032',
			'https://vimeo.com/125434519',
			'https://vimeo.com/126845728',
			'https://vimeo.com/125683264',
			'https://vimeo.com/125374670',
			'https://vimeo.com/125791075',
			'https://vimeo.com/127628756',
			'https://vimeo.com/123426885',
			'https://vimeo.com/127488750',
			'https://vimeo.com/122877916',
			'https://vimeo.com/127683345',
			'https://vimeo.com/126993594',
			'https://vimeo.com/126989174',
			'https://vimeo.com/127542984',
			'https://vimeo.com/125704539',
			'https://vimeo.com/126747807',
			'https://vimeo.com/124534647',
			'https://soundcloud.com/zedsdead/zeds-dead-twin-shadow-lost-you-feat-dangelo-lacy',
			'https://soundcloud.com/jozayrooks/fetty-wap-my-way-feat-monty',
			'https://soundcloud.com/majorlazer/major-lazer-dj-snake-lean-on-feat-mo',
			'https://soundcloud.com/p-teris-kr-vens/1-the-weekend-earned-it',
			'https://soundcloud.com/dejay-blaze/truffle-butter-feat-drake-lil-wayne',
			'https://soundcloud.com/djvanic/vanic-x-tove-styrke-borderline',
			'https://soundcloud.com/skrillex/ragga-bomb-skrillex-zomboy-remix',
			'https://soundcloud.com/borgore/ot-genasis-coco-borgore-remix',
			'https://soundcloud.com/circusrecords/flux-pavilion-exostomp-jump-up-high-diskord-remix-2',
			'https://www.flickr.com/photos/milamai/17448458230',
			'https://www.flickr.com/photos/billvarney/17652141365',
			'https://www.flickr.com/photos/alfarroba/17018487064/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/chrisnaton/17639833672/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/marcoferrarin/17448582220/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/iwonapodlasinska/17623690846/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/instame/17607382126/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/117605304@N07/17628858231/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/scarlet-poppy/17624995765/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/mwb-photos/17462458618/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/_zack/17611882206/in/explore-2015-05-14/',
			'https://www.flickr.com/photos/snevado/17457854078/in/explore-2015-05-14/',
		);

		return $urls[ mt_rand( 0, count( $urls ) - 1 ) ];
	}

	private function get_text (  ) {
		return wp_remote_retrieve_body( wp_remote_get( 'http://loripsum.net/api/1/short/plaintext' ) );
	}
}

WP_CLI::add_command( 'wpdrudge', 'PccWpCliAddOns' );