{$use_for_settings_variants = fn_settings_variants_image_verification_use_for()}
{$settings = fn_captchafox_get_use_for_settings($selected_storefront_id)}

{foreach $use_for_settings_variants as $variant => $variant_description}
    <div class="setting-wide">
        <label class="control-label" for="addon_captchafox_use_for_{$variant}">{$variant_description}:</label>
        <div class="controls">
            <label class="radio">
                <input
                    type="radio"
                    name="captchafox_use_for[{$variant}]"
                    id="addon_captchafox_use_for_{$variant}"
                    value="Y"
                    {if $settings.$variant == "Y"}checked="checked"{/if}
                >{__("captchafox.use_for_active")}
            </label>
            <label class="radio">
                <input
                    type="radio"
                    name="captchafox_use_for[{$variant}]"
                    id="addon_captchafox_use_for_{$variant}"
                    value=""
                    {if $settings.$variant == ""}checked="checked"{/if}
                >{__("captchafox.use_for_inactive")}
            </label>
        </div>
    </div>
{/foreach}
