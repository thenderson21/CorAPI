<div class="GoogleSiteSearch">
	<?php //Debug::dump($results); ?>
	<div class="form-wrapper">
	<form class="searchForm" action="/sitemap/search.php" method="post" accept-charset="utf-8">
				<select name="scope" id="gssScopeSelect">
					<option>All</option>
					<?php foreach ($scopeOptions as $key => $value) {?>
					 	<option value="<?php echo $key;?>"
					 	<?php if ( isset($scopeSelector) && $key === $scopeSelector) echo 'selected';?>>
					 	<?php echo $value['name'];?></option>
					<?php }?>
				</select>
		<input type="search" name="q" id="gssTextInput" <?php if (isset($q) && ! is_null($q)) echo ' value="' . $q . '"';?>>
		<input type="submit" value="" id="gssSubmitButton">
	</form>
	<div class="clear"></div>
	</div>
<?php 
if (isset($results) && ! is_null($results)) { ?>
	<div class="results">
		<span class="numResults">
		<?php 
		if (isset($results->RES->M) && ! is_null($results->RES->M)) {
			echo 'About ' . $results->RES->M . ' Results ' . round((float)$results->TM, 2) . ' (seconds)';
		} ?>
		</span>
		<?php
			if (isset($results->Spelling->Suggestion) && ! is_null($results->Spelling->Suggestion) ) {
				$sugestions = str_replace(' ', '+', strip_tags($results->Spelling->Suggestion));
			?>
			<span class="sugestions">
				Did you mean: 
					<a href="<?php echo $_SERVER['PHP_SELF'] . '?q=' . $sugestions; ?>">
					 	<?php echo $results->Spelling->Suggestion; ?>
					</a>
			</span>
		<?php 
			} //end if?>
	</div>
	<?php
		if (isset($results->RES->R) && ! is_null($results->RES->R)) {
			foreach ($results->RES->R as $result) {
				$attributes = $result->attributes();?>
			<div class="result">
				<span class="resultTitle">
				<?php if (isset($attributes['MIME']) && stripos($attributes['MIME'], 'pdf')) {?>
					<span class="mimeType">[PDF]</span>
				<?php } //end if MIME ?>
					<a href="<?php echo $result->U;?>">
						<?php echo $result->T;?>
					</a>
				</span>
				<span class="url"><?php echo $result->U;?></span>
				<span class="description"><?php echo $result->S;?></span>
			</div>
	<?php
			} //end foreach
		} else {?>
			<p>No results containing all your search terms were found.</p>
			<p>Your search - <strong><?php echo $q;?></strong> - did not match any documents.</p>
			<p>Suggestions:</p>
			<ul>
				<li>Make sure all words are spelled correctly.</li>
				<li>Try different keywords.</li>
				<li>Try more general keywords.</li>
				<li>Try fewer keywords.</li>
			</ul>
		<?php 
		}
		?>
	<div class="pagination">
	<?php if (isset($prev) && $prev != false) {?>
		<span class="previous"><a href="<?php echo $_SERVER['PHP_SELF'] . $prev;?>"> &laquo; Previous </a></span>
	<?php } ?>
	<?php if (isset($pageMenu) && $pageMenu != false) {?>
		<span class="pageMenu"><?php echo $pageMenu;?></span>
	<?php } ?>
	<?php if (isset($next) && $next != false) {?>
		<span class="next"><a href="<?php echo $_SERVER['PHP_SELF'] . $next;?>">Next &raquo;</a></span>
	<?php } ?>
	</div>
 <?php 
}?>
</div>
