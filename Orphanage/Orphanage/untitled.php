<div class="form-group <?php echo (!empty($rank_err)) ? 'has-error' : ''; ?>">
                            <label>Rank</label>
                            <input type="text" name="rank" class="form-control" value="<?php echo $rank; ?>">
                            <span class="help-block"><?php echo $rank_err;?></span>
                        </div>