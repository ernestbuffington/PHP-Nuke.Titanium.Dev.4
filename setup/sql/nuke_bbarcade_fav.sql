ALTER TABLE `#prefix#_bbarcade_fav`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order` (`order`);

