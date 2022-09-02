<?php exit; ?>
1662095093
SELECT m.*, u.user_colour, g.group_colour, g.group_type FROM (phpbbNuke_moderator_cache m) LEFT JOIN phpbbNuke_users u ON (m.user_id = u.user_id) LEFT JOIN phpbbNuke_groups g ON (m.group_id = g.group_id) WHERE m.display_on_index = 1
6
a:0:{}