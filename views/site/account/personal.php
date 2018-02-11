	<div class="row name">
		<h1><?= $account['username'] . ' ' . $account['surename']  ?></h1>
		<span class="days_on_the_site">На шкипере уже 64 дня</span>
		<hr/>
	</div>
	<div class="row pad_0">
		<div class="col-lg-5 col-md-5 pad_0">
			<div class="name_block">
				<span>Имя:</span>
				<span><?= $account['username']?></span>
			</div>
			<div class="surname_block">
				<span>Фамилия:</span>
				<span><?= $account['surename']?></span>
			</div>
			<div class="date_of_birth_block">
				<span>Дата рождения:</span>
				<span><?= date("d.m.Y", strtotime($account['birthday']));?></span>
			</div>
			<div class="city_block">
				<span>Город:</span>
				<span><?= $account['userCity'] ? $account['userCity'] : 'Не заполнено'?></span>
			</div>
			<div class="password_block">
				<a href="">Изменить пароль</a>
			</div>
		</div>
		<div class="col-lg-5 col-md-5 pad_0">
			<div class="phone_block">
				<span>Номер телефона:</span>
				<span><?= $account['userPhone']? $account['userPhone'] : 'Не заполнено' ?></span>
			</div>
			<div class="email_block">
				<span>E-mail:</span>
				<span><?= $account['email']?></span>
			</div>
			<div class="send_notifications_block">
				<label>
					<input type="checkbox" checked>
					Присылать уведомления на почту
				</label>
			</div>
			<div class="share_my_events_block">
				<label>
					<input type="checkbox" checked>
					Открыть доступ к моим событиям
				</label>
			</div>
			<div class="share_my_communities_block">
				<label>
					<input type="checkbox" checked>
					Открыть доступ к моим сообществам
				</label>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 pad_0 social">
			<a href="">1</a>
			<a href="">2</a>
			<a href="">3</a>
			<a href="">4</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 pad_0">
			<h2>Шкала опыта</h2>
			<hr/>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 pad_0">
			<h2>О себе:</h2>
			<hr/>
			<span>
                        <?= $account['userInfo']?>
                    </span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 pad_0 notice">
			<div class="notice_block">
				<h2>Мои уведомления:</h2>
				<a href="">Все уведомления</a>
			</div>
			<hr/>
		</div>
	</div>
