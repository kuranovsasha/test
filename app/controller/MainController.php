<?php
use Imy\Core\Controller;
use Imy\Core\Tools;

class MainController extends Controller
{
    function init()
    {
        // tpl
        $this->v['tpl'] = 'ajax_form';

        // form
        $this->v['button'] = 'Отправить';
        $this->v['opinion'] = 'Текст отзыва';
        $this->v['yourName'] = 'Ваше имя';
        $this->v['opinions'] = M('review')->get()->orderBy('id', 'DESC')->fetchAll();
    }

    function ajax_addOpinion() {
        parse_str($_POST['data'], $data);

        // валидация на бэке
        $validate = $this->validateOpinionForm($data);

        if ($validate['res']) {
            $review = M('review');
            $finalData = [
                'name' => $data['name'],
                'message' => $data['opinion'],
                'date' => date('Y-m-d H:i:s'),
            ];
            $review->setValues($finalData);
            $review->save();
            $this->v['dateFormat'] = date_format(date_create($finalData['date']), 'd-m-Y H:i');
        }
        $this->v['message'] = $validate['errors'];
        $this->v['res'] = $validate['res'];
        $this->v['data'] = $finalData ?? [];
    }

    private function validateOpinionForm($data) {
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = 'Поле Имя пустое';
        }
        if (empty($data['opinion'])) {
            $errors[] = 'Поле Текст отзыва пустое';
        }
        if (count($errors)) {
            $res = [
                'res' => false,
                'errors' => $errors,
            ];
        } else {
            $res = [
                'res' => true,
            ];
        }
        return $res;
    }

}
