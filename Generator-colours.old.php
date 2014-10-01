<tr>
	<th>Colour mode for days of the week:</th>
	<td>
		<input type="radio" name="colorMode" id="colorMode5" value='5' onclick='updatePreview()' <?php if (!isset($form['colorMode']) || $form['colorMode'] == '5') echo 'checked'; ?> /><label for='colorMode5'> Rainbow colours.</label><br />
		<input type="radio" name="colorMode" id="colorMode4" value='4' onclick='updatePreview()' <?php if ($form['colorMode'] == '4') echo 'checked'; ?> /><label for='colorMode4'> Traditional Thai colours.</label><br />
		<input type="radio" name="colorMode" id="colorMode3" value='3' onclick='updatePreview()' <?php if ($form['colorMode'] == '3') echo 'checked'; ?> /><label for='colorMode3'> Colour 1 for weekends, colour 2 for other days.</label><br />
		<input type="radio" name="colorMode" id="colorMode1" value='1' onclick='updatePreview()' <?php if ($form['colorMode'] == '1') echo 'checked'; ?> /><label for='colorMode1'> Interpolate colours: colour 1 for weekend, colour 2 for middle of week.</label><br />
		<input type="radio" name="colorMode" id="colorMode2" value='2' onclick='updatePreview()' <?php if ($form['colorMode'] == '2') echo 'checked'; ?> /><label for='colorMode2'> Interpolate colours: colour 1 for beginning of the week, colour 2 for end of week.</label><br />
	</td>
</tr>
<?php
for ($j = 1; $j <= 2; $j++)
{
	?>
	<tr id='color<?php echo $j; ?>' style='display: none'>
		<th>Colour <?php echo $j; ?>:</th>
		<td>
			<?php
			for ($i = 0; $i < count($cellColours); $i++)
			{
				print("<div class='colorOption' style='background-color: {$cellColours[$i]}'>
					<input type='radio' name='color$j' id='color{$j}_{$i}' class='colorRadio' value='{$cellColours[$i]}'");
				if ((!isset($form["color$j"]) && $i == 0) || $form["color$j"] == $cellColours[$i])
				{
					print(" checked");
				}
				println(" onclick='updatePreview()' /></div>");
			}
			?>
		</td>
	</tr>
	<?php
}
?>
<tr>
	<th>Border colour:</th>
	<td>
		<?php
		for ($i = 0; $i < count($borderColors); $i++)
		{
			print("<div class='colorOption' style='border-color: {$borderColors[$i]};'>
				<input type='radio' name='borderColor' id='borderColor[$i]' value='{$borderColors[$i]}' class='colorRadio'");
			if ((!isset($form['borderColor']) && $i == 1) || $form['borderColor'] == $borderColors[$i])
			{
				print(" checked");
			}
			println(" onclick='updatePreview()' /></div>");
		}
		?>
	</td>
</tr>
<tr>
	<th>Preview:</th>
	<td>
		<table border='1' cellspacing='0' cellpadding='3'>
		<tr>
		<?php
		for ($i = 1; $i <= count(EarthianDate::$dayNames); $i++)
		{
			println("<td id='dayName$i' class='dayName'>".EarthianDate::$dayNames[$i]."
				<input type='hidden' id='dayColors[$i]' name='dayColors[$i]' /></td>");
		}
		?>
		</tr>
		</table>
	</td>
</tr>

function updatePreview()
{
	var color1 = rbGetSelectedValue("color1");
	var color2 = rbGetSelectedValue("color2");
	var borderColor = rbGetSelectedValue("borderColor");
	var colorMode = parseInt(rbGetSelectedValue("colorMode"), 10);
	var dayColors = [];
	switch (colorMode)
	{
		case 1:
			show('color1');
			show('color2');
			dayColors[1] = Color.fromHexString(color1);
			dayColors[4] = Color.fromHexString(color2);
			dayColors[7] = Color.fromHexString(color1);
			var diff = Color.subtract(dayColors[4], dayColors[1]);
			var oneThird = Color.scale(diff, 1/3);
			dayColors[2] = Color.add(dayColors[1], oneThird);
			dayColors[3] = Color.subtract(dayColors[4], oneThird);
			dayColors[5] = Color.clone(dayColors[3]);
			dayColors[6] = Color.clone(dayColors[2]);
			break;
		case 2:
			show('color1');
			show('color2');
			dayColors[1] = Color.fromHexString(color1);
			dayColors[7] = Color.fromHexString(color2);
			var diff = Color.subtract(dayColors[7], dayColors[1]);
			var one7th = Color.scale(diff, 1/7);
			for (var i = 2; i <= 6; i++)
			{
				dayColors[i] = Color.add(dayColors[1], Color.scale(one7th, i - 1));
			}
			break;
		case 3:
			show('color1');
			show('color2');
			dayColors[1] = Color.fromHexString(color1);
			dayColors[2] = Color.fromHexString(color2);
			dayColors[3] = Color.fromHexString(color2);
			dayColors[4] = Color.fromHexString(color2);
			dayColors[5] = Color.fromHexString(color2);
			dayColors[6] = Color.fromHexString(color2);
			dayColors[7] = Color.fromHexString(color1);
			break;
		case 4:
			hide('color1');
			hide('color2');
			dayColors[1] = Color.fromHexString(cellColours[2]);
			dayColors[2] = Color.fromHexString(cellColours[4]);
			dayColors[3] = Color.fromHexString(cellColours[12]);
			dayColors[4] = Color.fromHexString(cellColours[6]);
			dayColors[5] = Color.fromHexString(cellColours[3]);
			dayColors[6] = Color.fromHexString(cellColours[9]);
			dayColors[7] = Color.fromHexString(cellColours[11]);
			break;
		case 5:
			hide('color1');
			hide('color2');
			dayColors[1] = Color.fromHexString(cellColours[2]);
			dayColors[2] = Color.fromHexString(cellColours[3]);
			dayColors[3] = Color.fromHexString(cellColours[4]);
			dayColors[4] = Color.fromHexString(cellColours[6]);
			dayColors[5] = Color.fromHexString(cellColours[8]);
			dayColors[6] = Color.fromHexString(cellColours[9]);
			dayColors[7] = Color.fromHexString(cellColours[11]);
			break;
	}
	var dayName;
	var dayColor;
	for (var d = 1; d <= 7; d++)
	{
		dayName = el('dayName' + d);
		dayColor = dayColors[d].toHexString();
		dayName.style.backgroundColor = dayColor;
		dayName.style.borderColor = borderColor;
		hfDayColor = el('dayColors[' + d + ']');
		hfDayColor.value = dayColor;
	}
}

updatePreview();

