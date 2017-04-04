<?php

class View
{
    /**
     * Подргужает представление и заменяет ключи значениями
     *
     * @param array $data
     * @return mixed|string
     */
    public static function render(array $data)
    {
        ob_start();
// ob_start - включает буферизацию вывода. Если буферизация вывода активна, вывод скрипта не высылается (кроме заголовков), а сохраняется во внутреннем буфере
        require './Views/home.php';
        $html = ob_get_clean();
// ob_get_clean() - Возвращает содержимое буфера вывода и заканчивает буферизацию вывода. Если буферизация вывода не активирована, то функция вернет FALSE
        foreach ($data as $key => $value)
		{
// подставляет в $html значение элемента $data[1]
            $html = str_replace('{{' . $key .'}}', $value, $html);
// str_replace - Заменяет строку поиска на строку замены
		}
        return $html;
    }
}