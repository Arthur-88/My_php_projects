<?php
class View
{
	public static function render(array $data)
	{
		ob_start();
		require './Views/accordion/index.html';
		$html = ob_get_clean();
		foreach ($data as $key => $value)
		{
			$html = str_replace('{{' . $key .'}}', $value, $html);
		}
		return $html;
	}
}
//	Подргужает представление и заменяет ключи значениями
// ob_start - включает буферизацию вывода. Если буферизация вывода активна, вывод скрипта не высылается (кроме заголовков), а сохраняется во внутреннем буфере
// ob_get_clean() - Возвращает содержимое буфера вывода и заканчивает буферизацию вывода. Если буферизация вывода не активирована, то функция вернет FALSE
// подставляет в $html значение элемента $data[1]
// str_replace - Заменяет строку поиска на строку замены