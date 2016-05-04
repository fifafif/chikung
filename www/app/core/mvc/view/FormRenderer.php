<?php

/**
 * Description of SmartyFormRender
 *
 * @author XiXao
 */
class FormRenderer
{
    public static function renderSelect($name, $options)
    {
        $output = "<select name=$name>\n";
        
        foreach ($options as $option)
        {
            $output .= '<option value="' . $option['value'] . '"' 
                    . ((isset($option['selected']) && $option['selected'] == 1) ? ' selected' : '')
                    . '>' . $option['text'] . "</option>\n";
        }
        
        $output .= "</select>\n";
        
        return $output;
    }
    
    public static function renderSelectComplex($name, $options)
    {
        $output = "<select name=$name>\n";
        
        foreach ($options as $option)
        {
            $output .= '<option value="' . $option['value'] . '" ' 
                    . ((isset($option['selected']) && $option['selected'] == 1) ? ' selected' : '')
                    . '>' . $option['text'] . '</option>';
        }
        
        $output .= '</select>';
        
        return $output;
    }
}
