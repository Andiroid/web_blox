<div class="accordion">Privacy</div>

<div class="panel">

	<!--—————————————————————————————————————————————————————————————————————————————————
		CHECK IF PROJECT IS PRIVATE OR PUBLIC START
	———————————————————————————————————————————————————————————————————————————————————-->

		<div>

			<input <?php if($p_pub == 1){echo 'checked';} ?> type="checkbox" name="publicCB" id="checkboxG1" class="css-checkbox" onclick='handlePUBLIC(this);' />

			<label for="checkboxG1" class="css-label">Public</label><span style="color:red;"> OR </span>

			<input type="hidden" name="p_pub" id="corePublicValue" value="" />			

			<input <?php if($p_pub == 0){echo 'checked';} ?> type="checkbox" name="privateCB" id="checkboxG2" class="css-checkbox" onclick='handlePRIVATE(this);' />

			<label for="checkboxG2" class="css-label">Private</label>

			<input type="hidden" name="p_priv" id="corePrivateValue" value="" />

			<script>

				var publicstate = document.getElementById('corePublicValue');
				var privatestate = document.getElementById('corePrivateValue');
				var publicCHECKBOX = document.getElementById('checkboxG1');
				var privateCHECKBOX = document.getElementById('checkboxG2');

				function handlePUBLIC(cb) {
						updateCOLLECTOR("public");
						publicstate.value=1;
						publicCHECKBOX .checked = true;
						privateCHECKBOX.checked = false;
						privatestate.value=0;
				
				}

				function handlePRIVATE(cb) {
						updateCOLLECTOR("public");
						publicstate.value=0;
						publicCHECKBOX .checked = false;
						privateCHECKBOX.checked = true;
						privatestate.value=1;
				}

			</script>						

		</div>

	<!--—————————————————————————————————————————————————————————————————————————————————
		CHECK IF PROJECT IS PRIVATE OR PUBLIC END
	———————————————————————————————————————————————————————————————————————————————————-->

</div>