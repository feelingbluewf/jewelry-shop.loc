<?php

namespace App\Services;
use App\Http\Controllers\Controller;
use Auth;

class Validation extends Controller {

	public function validateEmail($request) {

		$rules = [
			'email'=>'required|email'
		];

		$messages = [
			'requied'    => 'Нужно ввести пароль!',
			'email'    => 'Пароль должен соответствовать стандарту'
		];

		return $this->validate($request, $rules, $messages);

	}

	public function validatePassword($request) {

		$rules = [
			'current_password' => ['required', function ($attribute, $value, $fail){
				if (!\Hash::check($value, Auth::user()->password)) {
					return $fail(__('Неверный текущий пароль'));
				}
			}],
			'new_password' => 'required|min:8|max:16|same:repeat_new_password|different:current_password',
			'repeat_new_password' => 'required'
		];

		$messages = [
			'min'    => 'Пароль должен содержать минимум :min символов',
			'max'    => 'Пароль может содержать максимум :max символов',
			'same'    => 'Новые пароли не совпадают',
			'different' => 'Новый пароль должен отличаться от старого',
			'required' => 'Все поля должны быть заполнены'
		];

		return $this->validate($request, $rules, $messages);

	}

	public function validateUserData($request) {

		$rules = [
			'name' => 'required|min:2|max:30',
			'address' => 'required|min:5|max:50',
			'phone' => 'required|regex:/([+]372)[0-9]{7,10}/',
			'city' => 'required|min:3|max:20',
			'surename' => 'required|min:3|max:20'

		];

		$messages = [
			'name.required' => 'Введите своё имя',
			'address.required' => 'Введите свой адрес',
			'phone.required' => 'Введите свой номер телефона',
			'city.required' => 'Введите свой город',
			'surename.required' => 'Введите свою фамилию',
			'name.max' => 'Имя может содержать максимум :max символов',
			'name.min' => 'Имя должно содержать хотя бы :min символа',
			'address.max' => 'Адрес может содержать максимум :max символов',
			'address.min' => 'Адрес должно содержать хотя бы :min символа',
			'phone.regex' => "Телефон должен начинаться на '+372'",
			'city.max' => 'Город может содержать максимум :max символов',
			'city.min' => 'Город должно содержать хотя бы :min символа',
			'surename.max' => 'Фамилия может содержать максимум :max символов',
			'surename.min' => 'Фамилия должно содержать хотя бы :min символа'
		];

		return $this->validate($request, $rules, $messages);

	}

	public function validateAddressForm($request) {

		$rules = [
			'name' => 'required|min:2|max:30',
			'address' => 'required|min:5|max:50',
			'phone' => 'required|regex:/([+]372)[0-9]{7,10}/',
			'city' => 'required|min:3|max:20',
			'surename' => 'required|min:3|max:20',
			'email'=>'required|email'

		];

		$messages = [
			'name.required' => 'Введите своё имя',
			'address.required' => 'Введите свой адрес',
			'phone.required' => 'Введите свой номер телефона',
			'city.required' => 'Введите свой город',
			'surename.required' => 'Введите свою фамилию',
			'email.required' => 'Введите свою почту',
			'name.max' => 'Имя может содержать максимум :max символов',
			'name.min' => 'Имя должно содержать хотя бы :min символа',
			'address.max' => 'Адрес может содержать максимум :max символов',
			'address.min' => 'Адрес должно содержать хотя бы :min символа',
			'phone.regex' => "Телефон должен начинаться на '+372'",
			'city.max' => 'Город может содержать максимум :max символов',
			'city.min' => 'Город должно содержать хотя бы :min символа',
			'surename.max' => 'Фамилия может содержать максимум :max символов',
			'surename.min' => 'Фамилия должно содержать хотя бы :min символа',
			'email.max' => 'Почта может содержать максимум :max символов',
			'email.min' => 'Почта должно содержать хотя бы :min символа'
		];

		return $this->validate($request, $rules, $messages);

	}

	public function validateMethod($request) {

		$rules = [
			'method' => 'required'

		];

		$messages = [
			'required' => 'Выберите способ оплаты!'
		];

		return $this->validate($request, $rules, $messages);

	}

}

?>