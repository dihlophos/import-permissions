<?php

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `organizations` (`id`, `name`, `tin`) VALUES
                    (2, 'ООО МПК \"Тверецкий\"', '6901027320'),
                    (3, 'ООО \"Эколён\"', '6950003307'),
                    (4, 'ООО ТК \"Альфа\"', '6950127454'),
                    (5,	'ИП Измайлов Р.Ф',	'6903003610'),
                    (6, 'ООО \"ТВЕРСКОЙ МПЗ\"', '5027184629'),
                    (7, 'ОАО \"Мелькомбинат\"', '6903001493'),
                    (8, 'ООО \"РусКорм\"', '6950033213'),
                    (9, 'ООО \"Аллер Петфуд\"', '4703074719'),
                    (10, 'ООО \"Аллер Петфуд\"', '4703074719'),
                    (11, 'ООО \"ЗМК\"', '6949008163'),
                    (12, 'АО племзавод\"Заволжское\"', '6924003082'),
                    (13, 'АО Птицефабрика \"верхневолжская\"', '6924002730'),
                    (14, 'ООО \"НикитиН\"', '6901082384'),
                    (15, 'ООО \"Афанасий\"', '6901041204'),
                    (16, 'ООО\"Частная пивоварня Афанасий\"', '6977042074'),
                    (17, 'ООО \"Морозофф\"', '6950015687'),
                    (18, 'ООО ТТК \"Авэкс\"', '6950015711'),
                    (19, 'АО \"Тандер\"', '2310031475'),
                    (20, 'ЗАО ТД \"Перекресток\"', '7728029110'),
                    (21, 'ООО \"Бремор\"', '7722206719'),
                    (22, 'ООО\"Торговый Дом\"Северо-Запад\"', '6950008256'),
                    (23, 'ИП Убский Н.П.', '6903001137'),
                    (24, 'ООО \"Лента\"', '7814148471'),
                    (25, 'ООО \"Рубин\"', '6950119823'),
                    (26, 'ООО \"Айсвел-Т\"', '6950091991'),
                    (27, 'ООО \"ВОСТОК-ТРЭЙД\"', '6902031625'),
                    (28, 'ООО \"Флагман\"', '6950148616'),
                    (29, 'ЗАО\"Калининское\"', '6924003149'),
                    (30, 'ООО \"Интер Контракт\"', '6950078818'),
                    (31, 'ООО \"Метро Кэш энд Керри\"', '7704218694'),
                    (32, 'ООО \"Останкино-новый стандарт\"', '7701808423'),
                    (33, 'ИП Чесноков А.В.', '6902007076'),
                    (34, 'ООО \"Ритм\"-2000\"', '6905063488'),
                    (35, 'ООО \"Рубин\"', '6950119823'),
                    (36, 'ООО \"Рубин\"', '6950119823'),
                    (37, 'ООО \"Регион плюс\"', '6950189669'),
                    (38, 'ООО \"Меридиан\"', '6950048393'),
                    (39, 'ИП Иванов И.А.', '6904055762'),
                    (40, 'ООО \"Регион холод\"', '6950041140'),
                    (41, 'ООО \"Макс Фиш\"', '6950041285'),
                    (42, 'ИП Хромова С.С.', '6904005211'),
                    (43, 'ООО \"Пегас\"', '6950179050'),
                    (44, 'ООО \"Волжский бройлер\"', '6950100445'),
                    (45, 'ООО \"Гермес\"', '7718108275'),
                    (46, 'ООО \"ТРиКАФЕ и К\"', '6952012709'),
                    (47, 'ООО \"Акваторг\"', '6950173588'),
                    (48, 'ООО \"Звероплемзавод Савватьево\"', '6949003824'),
                    (49, 'ООО \"Меха\"', '6902030741'),
                    (50, 'ООО \"Птицефабрика Новопетровская\"', '5047045077'),
                    (51, 'ООО АПК \"Березино\"', ''),
                    (52, 'СПК \"Октябрьский\"', ''),
                    (53, 'Учхоз \"Сахарово\"', ''),
                    (54, 'ИП Никифорова О.А.', '6924032882'),
                    (55, 'ООО \"ТВЕРЬ-ТОРГ\"', '6950124005'),
                    (56, 'ООО \"ЛЕАН\"', '6950187037'),
                    (57, 'ООО \"Компания СТРИНГ\"', '6901071632')");
    }
}
