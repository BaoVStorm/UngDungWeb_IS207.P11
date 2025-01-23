import pandas as pd

load_category_id = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV\AllCategory.csv"
df_id = pd.read_csv(load_category_id)

dic_id = {}

for i in range(len(df_id)):
    dic_id[df_id["all_category"][i]] = df_id["id_category"][i]

input_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV\Pot_Category_.csv"

output_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV"

df = pd.read_csv(input_path)

for i in range(len(df)):
    df.at[i, "CATEGORYID"] = dic_id[df["CATEGORY"][i]]

df.to_csv(output_path + rf"\Pot_Category.csv", index=False, encoding="utf-8-sig")

print("Save successfully")