<?php

use VirtualProject\Helpers\MemberHelper;

return array(
    'required'    => ':attributeを入力してください。',
    'max'         => ':attributeは:max文字まで入力できます。',
    'vpemail'     => ':attributeには有効なメールアドレスを入力してください。',
    'password'    => ':attributeまたはパスワードが誤っています。',
    'confirmed'   => 'メールアドレスと:attributeが異なっています。',
    'unique'      => ':attributeは既に使用されています。',
    'vpdate'      => ':attributeは' . VP_DATE_MIN . 'から' . MemberHelper::getMaxDate() . 'までの範囲で入力してください。',
    'vptelephone' => ':attributeには有効な電話番号を入力してください。',
    'date'        => ':attributeはYYYY-mm-dd形式で入力してください。',
    'between'     => ':attributeは:min文字以上、:max文字以内で入力してください。',
    'user_not_delete_boss' => '部下が残っているBOSSを削除しようとしています。',
    'user_not_me_own' => '次のデータには部下が残っています。削除するためには全ての部下を解除してください',
    'user_not_exists' => '存在しないID：%sに対するアクセスがありました。',
    'deleted_id' => '削除されたID：%sに対するアクセスがありました。',
    'not_direct_access' => '確認画面を経由せずに直接参照されました。',
    'exists_employ_child' => '参照データに部下が残っています。',
    'not_match_email' => 'これらの資格情報は、当社の記録と一致しません。'
);