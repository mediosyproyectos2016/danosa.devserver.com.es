
<div id="commentsave<?=$form->id?>div" class="modalComments <?= ( $form->comments != "")? "widthComments":"widthoutComments"?>" data-modalid="comments_<?=$form->id?>">
 
 
	<svg class="widthoutComments ast-mobile-svg ast-menu2-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 28"><path color="gray" d="M24 21v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1zM24 13v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1zM24 5v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1z"></path></svg>
 
	<svg class="widthComments ast-mobile-svg ast-menu2-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 28"><path color="green" d="M24 21v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1zM24 13v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1zM24 5v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1z"></path></svg>
 

	 <div style="display: none;">		
		 <div id="comments_<?=$form->id?>">
			<p>Déja cualquier comentario que quieras guardar en esta descarga</p>
			 <textarea col="15" row="15" id="commentsave<?=$form->id?>text" >
				<?=$form->comments ?>
			 </textarea>
			 <button class="btn btn-primary" data-id="<?=$form->id?>" id="commentsave<?=$form->id?>"><?=__("Save")?></button>
		 </div>
	 </div>
 </div>